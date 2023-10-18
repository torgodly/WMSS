<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $users = null;
        $warehousesEdit = null;

        if (\Auth::user()->role == 1) {

            $warehouses = Warehouse::with('user')->orderBy('created_at', 'desc')->paginate(10);
            $users = User::all();

            if (\request('ID')) {
                $warehousesEdit = Warehouse::findOrFail(\request('ID'));
            }
        } elseif (\Auth::user()->role == 0) {
            $warehouses = \Auth::user()->warehouse()->with('user')->orderBy('created_at', 'desc')->paginate(10);
        }


        return view('warehouse.index', compact('warehouses', 'users', 'warehousesEdit'));
    }

    //store warehouse
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required|min:10',
            'phone' => 'required|min:10',
            'user_id' => 'required',
        ]);

        Warehouse::create($request->all());

        return redirect()->route('warehouse.index')
            ->with('message', 'Warehouse created successfully.');
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        return redirect()->route('warehouse.index')
            ->with('message', 'Warehouse deleted successfully.');
    }

    //show
    public function show(Warehouse $warehouse)
    {
        $productsEdit = null;
        $warehouse->load('products', 'user');
        //get only the products that are not attached to this warehouse simple way
        $products = Product::whereNotIn('id', $warehouse->products->pluck('id'))->get();
        if (\request('ID')) {
            $productsEdit = $warehouse->products->find(\request('ID'));

        }
        return view('warehouse.show', compact('warehouse', 'products', 'productsEdit'));
    }

    //update
    public function update(Request $request, Warehouse $warehouse)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required|min:10',
            'phone' => 'required|min:10',
            'user_id' => 'required',
        ]);

        $warehouse->update($request->all());

        return redirect()->route('warehouse.index')
            ->with('message', 'Warehouse updated successfully.');
    }


    //attach product
    public function attachProduct(Request $request, Warehouse $warehouse)
    {
        //check if product already attached
        if ($warehouse->products->contains($request->product_id)) {
            return redirect()->route('warehouse.show', $warehouse->id)
                ->with('message', 'Product already attached.');
        }
        $product = Product::findOrFail($request->product_id);
        $warehouse->products()->attach([$request->product_id => ['quantity' => $request->quantity, 'margin' => $request->margin]]);
        $InvoiceData = [
            'invoice_number' => uniqid('invoice-', false),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'customer_name' => 'warehouse' . ' ' . $warehouse->name,
            'price' => $product->price,
            'margin' => $request->margin,
            'type' => 'import',
        ];
        $warehouse->invoices()->create($InvoiceData);
        return redirect()->route('warehouse.show', $warehouse->id)
            ->with('message', 'Product attached successfully.');
    }

    //update product quantity
    public function updateProductQuantity(Request $request, Warehouse $warehouse)
    {
        //check if product already attached
        if (!$warehouse->products->contains($request->product_id)) {
            return redirect()->route('warehouse.show', $warehouse->id)
                ->with('message', 'Product not attached.');
        }
        $product = Product::findOrFail($request->product_id);
        $warehouse->products()->updateExistingPivot($request->product_id, ['quantity' => $request->quantity, 'margin' => $request->margin]);
        $InvoiceData = [
            'invoice_number' => uniqid('invoice-', false),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'customer_name' => 'warehouse' . ' ' . $warehouse->name,
            'price' => $product->price,
            'margin' => $request->margin,
            'type' => 'import',
        ];
        $warehouse->invoices()->create($InvoiceData);
        return redirect()->route('warehouse.show', $warehouse->id)
            ->with('message', 'Product quantity updated successfully.');
    }

    //detach product
    public function detachProduct(Request $request, Warehouse $warehouse)
    {
        //check if product already attached
        if (!$warehouse->products->contains($request->product_id)) {
            return redirect()->route('warehouse.show', $warehouse->id)
                ->with('message', 'Product not attached.');
        }

        $warehouse->products()->detach($request->product_id);
        return redirect()->route('warehouse.show', $warehouse->id)
            ->with('message', 'Product detached successfully.');
    }
}
