<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\WarehouseRequest;
// use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WarehousesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$warehouses = Warehouse::with('user')->paginate();


        // dd(Auth::user());
        // $user=Auth::user();
	    // return view('warehouses.index', compact('warehouses','user'));
         return view('warehouses.index', compact('warehouses'));
    }

    public function show(Warehouse $warehouse)
    {
        return view('warehouses.show', compact('warehouse'));
        // return $warehouse->user->warehouses;
    }

	public function create(Warehouse $warehouse)
	{
        // $user=Auth::user();
        $this->authorize('create', $warehouse);

		return view('warehouses.create_and_edit', compact('warehouse'));
	}

	public function store(WarehouseRequest $request)
	{
		$warehouse = Warehouse::create($request->all());
		return redirect()->route('warehouses.show', $warehouse->id)->with('message', 'Created successfully.');
	}

	public function edit(Warehouse $warehouse)
	{
        $this->authorize('update', $warehouse);
		return view('warehouses.create_and_edit', compact('warehouse'));
	}

	public function update(WarehouseRequest $request, Warehouse $warehouse)
	{
		$this->authorize('update', $warehouse);
		$warehouse->update($request->all());

		return redirect()->route('warehouses.show', $warehouse->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Warehouse $warehouse)
	{
		$this->authorize('destroy', $warehouse);
		$warehouse->delete();

		return redirect()->route('warehouses.index')->with('message', 'Deleted successfully.');
	}
}
