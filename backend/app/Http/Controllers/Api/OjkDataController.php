<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OjkData;
use Illuminate\Http\Request;

class OjkDataController extends Controller
{
    public function index(Request $request)
    {
        $query = OjkData::query();

        if ($request->has('institution_type')) {
            $query->byType($request->institution_type);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        } else {
            $query->active();
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('institution_name', 'like', '%' . $request->search . '%')
                  ->orWhere('registration_number', 'like', '%' . $request->search . '%');
            });
        }

        $ojkData = $query->paginate($request->get('per_page', 15));
        return response()->json($ojkData);
    }

    public function store(Request $request)
    {
        $request->validate([
            'institution_name' => 'required|string|max:255',
            'institution_type' => 'required|string|max:255',
            'registration_number' => 'required|string|unique:ojk_data',
            'status' => 'required|in:active,inactive,suspended',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'registration_date' => 'nullable|date',
            'additional_info' => 'nullable|string',
        ]);

        $ojkData = OjkData::create($request->all());
        return response()->json($ojkData, 201);
    }

    public function show(string $id)
    {
        $ojkData = OjkData::findOrFail($id);
        return response()->json($ojkData);
    }

    public function update(Request $request, string $id)
    {
        $ojkData = OjkData::findOrFail($id);

        $request->validate([
            'institution_name' => 'required|string|max:255',
            'institution_type' => 'required|string|max:255',
            'registration_number' => 'required|string|unique:ojk_data,registration_number,' . $id,
            'status' => 'required|in:active,inactive,suspended',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'registration_date' => 'nullable|date',
            'additional_info' => 'nullable|string',
        ]);

        $ojkData->update($request->all());
        return response()->json($ojkData);
    }

    public function destroy(string $id)
    {
        $ojkData = OjkData::findOrFail($id);
        $ojkData->delete();

        return response()->json(['message' => 'OJK data deleted successfully']);
    }
}
