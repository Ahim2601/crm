<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Models\MaintenanceDetail;
use App\Exports\MaintenanceExport;
use Maatwebsite\Excel\Facades\Excel;
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
            $data = Maintenance::with('customer');
            return DataTables::of($data)
                ->filter(function ($query) use ($request) {
                    if ($request->has('customer_id') && $request->get('customer_id') != '') {
                        $query->where('maintenances.customer_id', $request->get('customer_id'));
                    }

                    if ($request->has('start') && $request->has('end') && $request->get('start') != '' && $request->get('end') != '') {
                        $query->whereBetween('maintenances.created_at', [$request->get('start'), $request->get('end')]);
                    }

                    if ($request->has('status') && $request->get('status') != '') {
                        $query->where('maintenances.status', $request->get('status'));
                    }

                    if ($request->has('search') && $request->get('search')['value'] != '') {
                        $searchValue = $request->get('search')['value'];
                        $query->where(function ($subQuery) use ($searchValue) {
                            $subQuery->where('customers.business_name', 'like', "%{$searchValue}%")
                                    ->orWhere('customers.rut', 'like', "%{$searchValue}%");
                        });
                    }
                })
                ->addColumn('actions', function ($data) {
                    return view('maintenances.partials.actions', ['data' => $data]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        $customers = Customer::all();

        return view('maintenances.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Customer::all();
        $references = Category::all();
        return view('maintenances.create', compact('user', 'references'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaintenanceRequest $request)
    {
        $data = Maintenance::create([
            'customer_id'               => $request->customer_id,
            'user_id'                   => auth()->user()->id,
            'subtotal'                  => $request->subtotal,
            'iva'                       => $request->iva,
            'discount_percent'          => $request->discount_percentage,
            'discount'                  => $request->discount,
            'grand_total'               => $request->total,
            'description'               => $request->description,
            'start_date_maintenance'    => $request->start_date_maintenance,
            'end_date_maintenance'      => $request->end_date_maintenance,
            'time_recordatory'          => $request->time_recordatory,
        ]);
        $servicios = json_decode($request->array_products);
        foreach ($servicios as $item) {
            if ($item->type == 'Equipo') {
                $team = Team::where('description', $item->description)->first();
                MaintenanceDetail::create([
                    'maintenance_id'    => $data->id,
                    'team_id'           => $team->id,
                    'reference'         => $item->reference,
                    'quantity'          => $item->quantity,
                    'unit'              => $item->tipo,
                    'price'             => $item->price,
                    'subtotal'          => $item->subtotal,
                ]);
            } else {
                MaintenanceDetail::create([
                    'maintenance_id'    => $data->id,
                    'description'       => $item->description,
                    'reference'         => $item->reference,
                    'quantity'          => $item->quantity,
                    'unit'              => $item->tipo,
                    'price'             => $item->price,
                    'subtotal'          => $item->subtotal,
                ]);
            }
        }
        return redirect()->route('maintenance.index')->with('success', 'Mantenimiento creado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show($maintenance)
    {
        $maintenance = Maintenance::with('customer', 'details', 'details.team', )->find($maintenance);
        return response()->json($maintenance);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($maintenance_id)
    {
        $maintenance = Maintenance::with('customer', 'details', 'details.team')->find($maintenance_id);
        $customers = Customer::all();
        $references = Category::all();
        return view('maintenances.edit', compact('maintenance','customers', 'references'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(UpdateMaintenanceRequest $request, $maintenance_id)
    {
        $maintenance = Maintenance::find($maintenance_id);
        $maintenance->update([
            'customer_id'               => $request->customer_id,
            'user_id'                   => auth()->user()->id,
            'subtotal'                  => $request->subtotal,
            'iva'                       => $request->iva,
            'discount_percent'          => $request->discount_percentage,
            'discount'                  => $request->discount,
            'grand_total'               => $request->total,
            'description'               => $request->description,
            'start_date_maintenance'    => $request->start_date_maintenance,
            'end_date_maintenance'      => $request->end_date_maintenance,
            'time_recordatory'          => $request->time_recordatory,
        ]);
        $maintenance->details()->delete();
        $servicios = json_decode($request->array_products);
        foreach ($servicios as $item) {
            if ($item->type == 'Equipo') {
                $team = Team::where('description', $item->description)->first();
                MaintenanceDetail::create([
                    'maintenance_id'    => $maintenance_id,
                    'team_id'           => $team->id,
                    'reference'         => $item->reference,
                    'quantity'          => $item->quantity,
                    'unit'              => $item->tipo,
                    'price'             => $item->price,
                    'subtotal'          => $item->subtotal,
                ]);
            } else {
                MaintenanceDetail::create([
                    'maintenance_id'    => $maintenance_id,
                    'description'       => $item->description,
                    'reference'         => $item->reference,
                    'quantity'          => $item->quantity,
                    'unit'              => $item->tipo,
                    'price'             => $item->price,
                    'subtotal'          => $item->subtotal,
                ]);
            }
        }
        return redirect()->route('maintenance.index')->with('success', 'Mantenimiento actualizado con exito');
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

    public function getCustomersTeams(Request $request)
    {
        $customers = Customer::with('teams')->where('id', $request->id)->first();
        $teams = $customers->teams;
        return response()->json($teams);
    }

    public function cambiarStatus(Request $request)
    {
        $quote = Maintenance::find($request->id);
        $quote->update([
            'status' => $request->status
        ]);
        return redirect()->route('maintenance.index')->with('success', 'Status de Mantenimiento Actualizada Correctamente');
    }

    public function store_file_invoice(Request $request)
    {
        $maintenance = Maintenance::find($request->id);
        $maintenance->update([
            'factura' => request()->file('invoice')->storeAs('facturas', request()->file('invoice')->getClientOriginalName(), 'public')
        ]);
        return redirect()->route('maintenance.index')->with('success', 'Factura cargada con exito');
    }

    public function exportar_mantenimientos(Request $request)
    {
        return Excel::download(new MaintenanceExport($request->start, $request->end), 'mantenimientos.xlsx');
    }
}
