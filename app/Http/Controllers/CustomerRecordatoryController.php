<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Maintenance;
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
            $data = Maintenance::with('customer');
    
            return DataTables::of($data)
                ->filter(function ($query) use ($request) {
                    
                    // if ($request->has('month') && $request->get('month') != '') {
                    //     $mes = (int) $request->get('month');
                    //     dd($request->month);
                    //     $query->where( DB::raw('MONTH(maintenances.date_prox_maintenance) = ?', [$mes]));
                    // }  

                    // $query->whereMonth('maintenances.date_prox_maintenance', now()->month);
                    
                })
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
