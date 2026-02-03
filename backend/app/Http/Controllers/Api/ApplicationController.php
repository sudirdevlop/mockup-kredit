<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::with(['user', 'product.category']);

        if ($request->user()->isUser()) {
            $query->where('user_id', $request->user()->id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->latest()->paginate($request->get('per_page', 15));
        return response()->json($applications);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric|min:0',
            'tenor' => 'required|integer|min:1',
            'interest_rate' => 'required|numeric|min:0',
            'applicant_data' => 'nullable|array',
        ]);

        $application = Application::create([
            'user_id' => $request->user()->id,
            'product_id' => $request->product_id,
            'application_number' => Application::generateApplicationNumber(),
            'amount' => $request->amount,
            'tenor' => $request->tenor,
            'interest_rate' => $request->interest_rate,
            'status' => 'pending',
            'applicant_data' => $request->applicant_data,
            'submitted_at' => now(),
        ]);

        return response()->json($application->load(['product', 'user']), 201);
    }

    public function show(Request $request, string $id)
    {
        $application = Application::with(['user', 'product.category'])->findOrFail($id);

        if ($request->user()->isUser() && $application->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($application);
    }

    public function update(Request $request, string $id)
    {
        $application = Application::findOrFail($id);

        if (!$request->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'status' => 'required|in:pending,approved,rejected,processing',
            'notes' => 'nullable|string',
        ]);

        $application->update([
            'status' => $request->status,
            'notes' => $request->notes,
            'processed_at' => now(),
        ]);

        return response()->json($application);
    }

    public function destroy(string $id)
    {
        $application = Application::findOrFail($id);
        $application->delete();

        return response()->json(['message' => 'Application deleted successfully']);
    }
}
