<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('provider', 'like', '%' . $request->search . '%');
            });
        }

        $products = $query->paginate($request->get('per_page', 15));
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'interest_rate_min' => 'required|numeric|min:0',
            'interest_rate_max' => 'required|numeric|min:0',
            'tenor_min' => 'required|integer|min:1',
            'tenor_max' => 'required|integer|min:1',
            'amount_min' => 'required|numeric|min:0',
            'amount_max' => 'required|numeric|min:0',
            'provider' => 'required|string|max:255',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'interest_rate_min' => $request->interest_rate_min,
            'interest_rate_max' => $request->interest_rate_max,
            'tenor_min' => $request->tenor_min,
            'tenor_max' => $request->tenor_max,
            'amount_min' => $request->amount_min,
            'amount_max' => $request->amount_max,
            'requirements' => $request->requirements,
            'benefits' => $request->benefits,
            'provider' => $request->provider,
            'image' => $request->image,
            'is_active' => $request->get('is_active', true),
        ]);

        return response()->json($product, 201);
    }

    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'interest_rate_min' => 'required|numeric|min:0',
            'interest_rate_max' => 'required|numeric|min:0',
            'tenor_min' => 'required|integer|min:1',
            'tenor_max' => 'required|integer|min:1',
            'amount_min' => 'required|numeric|min:0',
            'amount_max' => 'required|numeric|min:0',
            'provider' => 'required|string|max:255',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'interest_rate_min' => $request->interest_rate_min,
            'interest_rate_max' => $request->interest_rate_max,
            'tenor_min' => $request->tenor_min,
            'tenor_max' => $request->tenor_max,
            'amount_min' => $request->amount_min,
            'amount_max' => $request->amount_max,
            'requirements' => $request->requirements,
            'benefits' => $request->benefits,
            'provider' => $request->provider,
            'image' => $request->image,
            'is_active' => $request->get('is_active', $product->is_active),
        ]);

        return response()->json($product);
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
