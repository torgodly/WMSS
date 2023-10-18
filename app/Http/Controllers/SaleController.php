<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class SaleController extends Controller
{



    public function show(Warehouse $warehouse)
    {
        $price = null;
        $total = null;
        $product = null;
        $warehouse->load('products');
        if (\request('product_id') && \request('quantity')) {
            $product = $warehouse->products->find(\request('product_id'));
            if ($product->pivot->quantity >= \request('quantity')) {
                $price = $product->price * $product->pivot->margin / 100 + $product->price;
                $total = $price * \request('quantity');
            } else {
                return redirect()->route('sale.show', $warehouse)->with('message', 'Not enough quantity, you have' . ' ' . $product->pivot->quantity . ' ' . 'in stock');
            }
        }
        return view('sale.show', [
            'warehouse' => $warehouse,
            'price' => $price,
            'total' => $total,
            'Product' => $product,
        ]);
    }


    //store sale
    public function store(Warehouse $warehouse, $product, $quantity, Request $request)
    {

        $product = $warehouse->products->find($product);
        $InvoiceData = [
            'invoice_number' => uniqid('invoice-', false),
            'product_id' => $product->id,
            'quantity' => $quantity,
            'customer_name' => $request->customer_name,
            'price' => $product->price,
            'margin' => $product->pivot->margin,
            'type' => 'export',
        ];
        if ($product->pivot->quantity >= $quantity) {
            $product->pivot->quantity -= $quantity;
            $product->pivot->save();
            $warehouse->invoices()->create($InvoiceData);
            return redirect()->route('sale.show', $warehouse)->with('message', 'Sale completed');
        } else {
            return redirect()->route('sale.show', $warehouse)->with('message', 'Not enough quantity, you have' . ' ' . $product->pivot->quantity . ' ' . 'in stock');
        }
    }
}
