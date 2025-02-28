<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use Yajra\DataTables\Facades\DataTables;

class TeamController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create($customer_id)
    {
        $customer = Customer::find($customer_id);
        return view('teams.create', compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request, $customer_id)
    {
        $request['customer_id'] = $customer_id;
        Team::create($request->all());
        return redirect()->route('customer.show', $customer_id)->with('success', 'Equipo creado con exito');
    }


    public function edit($team_id, $customer_id)
    {
        $team = Team::find($team_id);
        return view('teams.edit', compact('team', 'customer_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(UpdateTeamRequest $request, $team_id, $customer)
    {
        $team = Team::find($team_id);
        $team->update($request->all());
        return redirect()->route('customer.show', $customer)->with('success', 'equipo actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($team)
    {
        $team = Team::find($team);
        $team->delete();
        return redirect()->back()->with('success', 'Equipo eliminado con exito');
    }
}
