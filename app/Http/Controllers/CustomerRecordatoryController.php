<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CustomerRecordatoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $customers = Customer::select([
                'customers.business_name as empresa',
                'customers.name as contacto',
                'customers.rut',
                'customers.phone',
                'customers.email',
                'm.end_date_maintenance as fecha_fin',
                DB::raw("
                    CASE 
                        WHEN m.time_recordatory = '1 mes' THEN DATE_ADD(m.end_date_maintenance, INTERVAL 30 DAY)
                        WHEN m.time_recordatory = '2 meses' THEN DATE_ADD(m.end_date_maintenance, INTERVAL 60 DAY)
                        WHEN m.time_recordatory = '3 meses' THEN DATE_ADD(m.end_date_maintenance, INTERVAL 90 DAY)
                        WHEN m.time_recordatory = '4 meses' THEN DATE_ADD(m.end_date_maintenance, INTERVAL 120 DAY)
                        WHEN m.time_recordatory = '5 meses' THEN DATE_ADD(m.end_date_maintenance, INTERVAL 150 DAY)
                        WHEN m.time_recordatory = '6 meses' THEN DATE_ADD(m.end_date_maintenance, INTERVAL 180 DAY)
                        ELSE m.end_date_maintenance
                    END AS proximo
                ")
            ])
            ->join('maintenances as m', 'customers.id', '=', 'm.customer_id')
            ->whereRaw("m.id = (SELECT MAX(id) FROM maintenances WHERE customer_id = customers.id)");
        
            return DataTables::of($data)
                // ->filter(function ($query) use ($request) {
                //     if ($request->has('customer_id') && $request->get('customer_id') != '') {
                //         $query->where('maintenances.customer_id', $request->get('customer_id'));
                //     }

                //     if ($request->has('start') && $request->has('end') && $request->get('start') != '' && $request->get('end') != '') {
                //         $query->whereBetween('maintenances.created_at', [$request->get('start'), $request->get('end')]);
                //     }

                //     if ($request->has('status') && $request->get('status') != '') {
                //         $query->where('maintenances.status', $request->get('status'));
                //     }

                //     if ($request->has('search') && $request->get('search')['value'] != '') {
                //         $searchValue = $request->get('search')['value'];
                //         $query->where(function ($subQuery) use ($searchValue) {
                //             $subQuery->where('customers.business_name', 'like', "%{$searchValue}%")
                //                     ->orWhere('customers.rut', 'like', "%{$searchValue}%");
                //         });
                //     }
                // })
                ->addColumn('actions', function ($data) {
                    return view('customer-recordatory.partials.actions', ['data' => $data]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('customer-recordatory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
