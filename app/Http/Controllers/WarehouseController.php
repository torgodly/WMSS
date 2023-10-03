<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::with('user')->orderBy('created_at', 'desc')->paginate(10);
        $users = User::all();
        return view('warehouse.index', compact('warehouses', 'users') );
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
}
