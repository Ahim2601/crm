<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = User::where('name', '!=', 'Desarrollador')->get();
        return view('users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'Super Admin')->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->all();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        $user->assignRole($request->rol);
        return redirect()->route('user.index')->with('success', 'Usuario creado con exito');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::find($id);
        $roles = Role::where('name', '!=', 'Super Admin')->get();
        return view('users.edit', compact('data', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        foreach ($user->getRoleNames() as $item) {
            $user->removeRole($item);
        }
        $user->assignRole($request->rol);
        $user->save();

        return redirect()->route('user.index')->with('success', 'Usuario actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::find($id);
        if ($data->todolists()->count() > 0) {
            return redirect()->route('user.index')->with('error', 'No se puede eliminar el usuario, posee registros relacionados');
        }
        $data->delete();

        return redirect()->route('user.index')->with('success', 'Usuario eliminado con exito');
    }
}
