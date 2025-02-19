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
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Team::all();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('teams.partials.actions', ['id' => $data->id]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('teams.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            $user = Customer::all();
            return view('teams.create', compact('user'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
            Team::create($request->all());
            return redirect()->route('team.index')->with('success', 'equipo creado con exito');

    }

    /**
     * Display the specified resource.
     */
    public function show($team)
    {
        $team = Team::find($team);
        return response()->json($team);
    }

    public function edit($team_id)
    {
        $team = Team::find($team_id);
        $user = Customer::all();
        return view('teams.edit', compact('team','user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(UpdateTeamRequest $request, $team_id)
    {
        $team = Team::find($team_id);
        $team->update($request->all());
        return redirect()->route('team.index')->with('success', 'equipo actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($team)
    {
        $team = Team::find($team);
        $team->delete();
        return redirect()->route('team.index')->with('success', 'Equipo eliminado con exito');
    }
}
