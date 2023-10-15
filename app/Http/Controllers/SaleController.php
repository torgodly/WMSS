<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;

class SaleController extends Controller
{
    public function show(Warehouse $warehouse)
    {
        $price = null;
        $total = null;
        $product= null;
        $warehouse->load('products');
        if (\request('product_id') && \request('quantity')) {
            $product = $warehouse->products->find(\request('product_id'));
            if ($product->pivot->quantity >= \request('quantity')) {
                $price = $product->price * $product->pivot->margin / 100 + $product->price;
                $total = $price * \request('quantity');
            } else {
                return redirect()->route('sale.show', $warehouse)->with('message', 'Not enough quantity, you have'.' '.$product->pivot->quantity.' '.'in stock');
            }
        }
        return view('sale.show', compact('warehouse', 'price', 'total', 'product'));
    }


    //store sale
    public function store(Warehouse $warehouse, $product, $quantity)
    {
        $product = $warehouse->products->find($product);
        if ($product->pivot->quantity >= $quantity) {
            $product->pivot->quantity -= $quantity;
            $product->pivot->save();
            return redirect()->route('sale.show', $warehouse)->with('message', 'Sale completed');
        } else {
            return redirect()->route('sale.show', $warehouse)->with('message', 'Not enough quantity, you have'.' '.$product->pivot->quantity.' '.'in stock');
        }
    }
}
