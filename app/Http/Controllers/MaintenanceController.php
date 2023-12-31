<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Http\Requests\StoreMaintenanceRequest;
use App\Http\Requests\UpdateMaintenanceRequest;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Maintenances = Maintenance::all();
        return response()->json($Maintenances);
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
    public function store(StoreMaintenanceRequest $request)
    {
        $validatedData = $request->validate([
            'jenis_maintenance' => 'required',
            'maintenance' => 'required|max:50',
            'tanggal_maintenance' => 'required|date',
            'id_barang' => 'required|integer',
            'id_user' => 'required|integer',
            'id_pekerja'=> 'required|integer'
        ]);

        $maintenance = new Maintenance;
        $maintenance->jenis_maintenance = $validatedData['jenis_maintenance'];
        $maintenance->maintenance = $validatedData['maintenance'];
        $maintenance->tanggal_maintenance = $validatedData['tanggal_maintenance'];
        $maintenance->id_barang = $validatedData['id_barang'];
        $maintenance->id_user = $validatedData['id_user'];
        $maintenance->id_pekerja= $validatedData['id_pekerja'];
        $result = $maintenance->save();

        if ($result) {
            return response()->json(['message' => 'Data maintenance berhasil disimpan']);
        } else {
            return response()->json(['message' => 'Data maintenance gagal disimpan']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $maintenance = Maintenance::where('id_barang', '=', '$id')->first();
        return response()->json($maintenance);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaintenanceRequest $request, $id)
    {
        $validatedData = $request->validate([
            'maintenance' => 'required|max:50',
            'tanggal_maintenance' => 'required|date',
            'id_barang' => 'required|integer',
            'id_user' => 'required|integer',
        ]);

        $maintenance = Maintenance::find($id);

        if (!$maintenance) {
            $maintenance = new Maintenance;
        }

        $maintenance->maintenance = $validatedData['maintenance'];
        $maintenance->tanggal_maintenance = $validatedData['tanggal_maintenance'];
        $maintenance->id_barang = $validatedData['id_barang'];
        $maintenance->id_user = $validatedData['id_user'];
        $result = $maintenance->save();

        if ($result) {
            return response()->json(['message' => 'Data maintenance berhasil diperbarui']);
        } else {
            return response()->json(['message' => 'Data maintenance gagal diperbarui']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $maintenance = Maintenance::find($id);

        if (!$maintenance) {
            return response()->json(['message' => 'Data maintenance tidak ditemukan'], 404);
        }

        $result = $maintenance->delete();

        if ($result) {
            return response()->json(['message' => 'Data maintenance berhasil dihapus']);
        } else {
            return response()->json(['message' => 'Data maintenance gagal dihapus'], 500);
        }
    }

}
