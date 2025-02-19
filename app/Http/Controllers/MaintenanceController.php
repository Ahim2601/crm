<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreMaintenanceRequest;
use App\Http\Controllers\MaintenanceController;
use App\Http\Requests\UpdateMaintenanceRequest;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Maintenance::all();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('maintenances.partials.actions', ['id' => $data->id]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('maintenances.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            $user = Customer::all();
            return view('maintenances.create', compact('user'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaintenanceRequest $request)
    {
        Maintenance::create($request->all());
        return redirect()->route('maintenance.index')->with('success', 'Mantenimiento creado con exito');

    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($maintenance_id)
    {
        $maintenance= Maintenance::find($maintenance_id);
        $user = Customer::all();
        return view('maintenances.edit', compact('maintenance','user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(UpdateMaintenanceRequest $request, $maintenance_id)
    {
        $maintenance = Maintenance::find($maintenance_id);
        $maintenance->update($request->all());
        return redirect()->route('maintenance.index')->with('success', 'mantemient actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($maintenance)
    {
        $maintenance = Maintenance::find($maintenance);
        $maintenance->delete();
        return redirect()->route('maintenance.index')->with('success', 'Mantenimiento eliminado con exito');
    }
}
