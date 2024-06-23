<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show All Products
    public function index()
    {
        $products = Product::latest()->paginate('5');
        return view('products.index', compact('products'));
    }

    // Show Single Products
    public function show($id)
    {
        $product = Product::find($id);
        // dd($product);
        // return view('products.show', ['product' => $product]);
        return view('products.show', compact('product'));
    }

    // Show New Product Form
    public function create()
    {
        return view('products.create');
    }

    // Create New Product
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'title' => 'required',
            'sku' => 'required|unique:products|max:999|integer',
            'price' => 'required|min:3',
            'description' => 'required',
        ]);
        $validated['sku'] = 'SKU-' . $request['sku'];
        Product::create($validated);

        return redirect()->route('productsAll')->with('message', 'Product Created Successfully.');
    }

    // Edit Product
    public function edit($id)
    {
        // dd($request);
        $product = Product::find($id);
        return view('products.edit', ['product' => $product]);
    }

    // Update New Product
    public function update(Request $request, $id)
    {
        // dd($request);

        $request->validate([
            'title' => 'required',
            'sku' => 'required|unique:products|max:999|integer',
            'price' => 'required',
            'description' => 'required',
        ]);
        $request['sku'] = 'SKU-' . $request['sku'];
        $product = Product::find($id);
        $product->update($request->all());
        return redirect()->route('productsAll')->with('message', 'Product Updated Successfully.');
    }

    // Delete Product
    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('productsAll')->with('message', 'Product Deleted Successfully.');
    }
}
