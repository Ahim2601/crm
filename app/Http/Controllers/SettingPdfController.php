<?php

namespace App\Http\Controllers;

use App\Models\SettingPdf;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateSettingRequest;

class SettingPdfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SettingPdf::all();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('setting.partials.actions', ['id' => $data->id]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('setting.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($settingPdf)
    {
        $data = SettingPdf::find($settingPdf);
        return view('setting.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, $settingPdf)
    {
        $data = SettingPdf::find($settingPdf);
        $data->update($request->all());
        return redirect()->route('settings.index')->with('success', 'Configuración actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SettingPdf $settingPdf)
    {
        //
    }
}
