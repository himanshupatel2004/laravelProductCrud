<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductValidate;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function index(Request $request)
{
    $search = $request->input('search');
    $products = Product::when($search, function ($query, $search) {
        return $query->where('name', 'like', "%$search%")
                     ->orWhere('description', 'like', "%$search%");
    })->orderBy('id', 'desc')->paginate(10);

    if ($request->ajax()) {
        return view('products.ajax-list', compact('products'))->render();
    }

    return view('products.list', compact('products', 'search'));
}


    public function create()
    {
        return view('products.create');
    }

    public function store(ProductValidate $request)
    {
        Product::create($request->validated());
        return redirect()->route('products.list')->with('success', 'Product added successfully.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(ProductValidate $request)
    {
        $product = Product::findOrFail($request->id);
        $product->update($request->validated());

        return redirect()->route('products.list')->with('success', 'Product updated successfully.');
    }

    public function delete($id) // Added delete method
    {
        $product = Product::findOrFail($id);
        return view('products.delete', compact('product'));
    }

    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->delete();

        return redirect()->route('products.list')->with('success', 'Product deleted.');
    }
}