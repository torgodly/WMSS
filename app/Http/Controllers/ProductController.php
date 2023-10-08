<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $productsEdit = null;
        $products = \App\Models\Product::orderBy('created_at', 'desc')->paginate(10);

        if (\request('ID')) {
            $productsEdit = Product::findOrFail(\request('ID'));
        }
        return view('products.index', compact('products', 'productsEdit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'expiration' => 'required|date',
            'company' => 'required',
        ]);

        \App\Models\Product::create($request->all());

        return redirect()->route('product.index');
    }

    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'expiration' => 'required|date',
            'company' => 'required',
        ]);

        $product = \App\Models\Product::find($id);
        $product->update($request->all());

        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        $product = \App\Models\Product::find($id);
        $product->delete();

        return redirect()->route('product.index');
    }
}
