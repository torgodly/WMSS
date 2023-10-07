<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehousesEdit = null;

        $warehouses = Warehouse::with('user')->orderBy('created_at', 'desc')->paginate(10);
        $users = User::all();

        if (\request('ID')) {
            $warehousesEdit = Warehouse::findOrFail(\request('ID'));
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
        return view('warehouse.show', compact('warehouse'));
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
}
