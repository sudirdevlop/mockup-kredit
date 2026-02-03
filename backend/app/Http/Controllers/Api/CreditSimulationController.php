<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CreditSimulation;
use Illuminate\Http\Request;

class CreditSimulationController extends Controller
{
    public function index(Request $request)
    {
        $query = CreditSimulation::with(['product.category']);

        if ($request->user()) {
            $query->where('user_id', $request->user()->id);
        }

        $simulations = $query->latest()->paginate($request->get('per_page', 15));
        return response()->json($simulations);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'loan_amount' => 'required|numeric|min:0',
            'tenor' => 'required|integer|min:1',
            'interest_rate' => 'required|numeric|min:0',
        ]);

        $calculation = CreditSimulation::calculate(
            $request->loan_amount,
            $request->tenor,
            $request->interest_rate
        );

        $simulation = CreditSimulation::create([
            'user_id' => $request->user() ? $request->user()->id : null,
            'product_id' => $request->product_id,
            'loan_amount' => $request->loan_amount,
            'tenor' => $request->tenor,
            'interest_rate' => $request->interest_rate,
            'monthly_payment' => $calculation['monthly_payment'],
            'total_payment' => $calculation['total_payment'],
            'total_interest' => $calculation['total_interest'],
            'ip_address' => $request->ip(),
        ]);

        return response()->json($simulation->load('product'), 201);
    }

    public function show(string $id)
    {
        $simulation = CreditSimulation::with(['product.category', 'user'])->findOrFail($id);
        return response()->json($simulation);
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'loan_amount' => 'required|numeric|min:0',
            'tenor' => 'required|integer|min:1',
            'interest_rate' => 'required|numeric|min:0',
        ]);

        $calculation = CreditSimulation::calculate(
            $request->loan_amount,
            $request->tenor,
            $request->interest_rate
        );

        return response()->json($calculation);
    }

    public function destroy(string $id)
    {
        $simulation = CreditSimulation::findOrFail($id);
        $simulation->delete();

        return response()->json(['message' => 'Simulation deleted successfully']);
    }
}
