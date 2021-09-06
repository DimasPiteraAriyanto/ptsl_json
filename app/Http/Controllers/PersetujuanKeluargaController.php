<?php

namespace App\Http\Controllers;

use App\Models\PersetujuanKeluarga;
use App\Models\Berkas;
use App\Models\Proyek;
use App\Models\TempPersetujuanKeluarga;
use App\Models\Penlok;
use App\Models\Desa;
use Illuminate\Http\Request;
use Redirect, Response;
use Yajra\DataTables\DataTables;

class PersetujuanKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pid = $request->pid;
        $nob = $request->nob;
        $doc = $request->doc;
        return view('auths.persetujuan-keluarga.index', compact(
            'pid',
            'nob',
            'doc',
        ));
    }

    public function json_persetujuan_keluarga_index(Request $request){
        $data = PersetujuanKeluarga::orderBy('id', 'DESC')->get();

        $dpersetujuan_keluarga = array();
        foreach($data as $persetujuan_keluarga){
            $dpersetujuan_keluarga[] = array(
                'id' => $persetujuan_keluarga->id,
                'nama_persetujuan_keluarga' => $persetujuan_keluarga->nama_persetujuan_keluarga,
                'nik' => $persetujuan_keluarga->nik,
                'no_telp' => $persetujuan_keluarga->no_telp,
                'alamat' => $persetujuan_keluarga->desa." - ".$persetujuan_keluarga->kecamatan.", ".$persetujuan_keluarga->kabupaten,
            );
        }

        return Datatables::of($dpersetujuan_keluarga)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $persetujuan_keluarga = new PersetujuanKeluarga();
        $persetujuan_keluarga->nik = $request->nik;
        $persetujuan_keluarga->no_telp = $request->no_telp;
        $persetujuan_keluarga->nama_persetujuan_keluarga = $request->nama_persetujuan_keluarga;
        $persetujuan_keluarga->tempat_lahir = $request->tempat_lahir;
        $persetujuan_keluarga->tanggal_lahir = $request->tanggal_lahir;
        $persetujuan_keluarga->pekerjaan = $request->pekerjaan;
        $persetujuan_keluarga->agama = $request->agama;
        $persetujuan_keluarga->jenis_kelamin = $request->jenis_kelamin;
        $persetujuan_keluarga->desa = $request->desa;
        $persetujuan_keluarga->kecamatan = $request->kecamatan;
        $persetujuan_keluarga->kabupaten = $request->kabupaten;
        $persetujuan_keluarga->save();
        return response()->json($persetujuan_keluarga); 
    }

    public function json_persetujuan_keluarga_edit(Request $request)
    {
        $persetujuan_keluarga = PersetujuanKeluarga::find($request->id);
        return response()->json($persetujuan_keluarga);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PersetujuanKeluarga  $persetujuan_keluarga
     * @return \Illuminate\Http\Response
     */
    public function show(PersetujuanKeluarga $persetujuan_keluarga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersetujuanKeluarga  $persetujuan_keluarga
     * @return \Illuminate\Http\Response
     */
    public function edit(PersetujuanKeluarga $persetujuan_keluarga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersetujuanKeluarga  $persetujuan_keluarga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersetujuanKeluarga $persetujuan_keluarga, $id)
    {
        $persetujuan_keluarga = PersetujuanKeluarga::find($id);
        $persetujuan_keluarga->nik = $request->nik;
        $persetujuan_keluarga->no_telp = $request->no_telp;
        $persetujuan_keluarga->nama_persetujuan_keluarga = $request->nama_persetujuan_keluarga;
        $persetujuan_keluarga->tempat_lahir = $request->tempat_lahir;
        $persetujuan_keluarga->tanggal_lahir = $request->tanggal_lahir;
        $persetujuan_keluarga->pekerjaan = $request->pekerjaan;
        $persetujuan_keluarga->agama = $request->agama;
        $persetujuan_keluarga->jenis_kelamin = $request->jenis_kelamin;
        $persetujuan_keluarga->desa = $request->desa;
        $persetujuan_keluarga->kecamatan = $request->kecamatan;
        $persetujuan_keluarga->kabupaten = $request->kabupaten;
        $persetujuan_keluarga->update();
        return response()->json($persetujuan_keluarga); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersetujuanKeluarga  $persetujuan_keluarga
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersetujuanKeluarga $persetujuan_keluarga, $id)
    {
        PersetujuanKeluarga::destroy($id);
    }

    public function entri_persetujuan_keluarga(Request $request)
    {
        TempPersetujuanKeluarga::create([
            'persetujuan_keluarga_id' => $request->id,
            'session' => $request->session,
        ]);
    }

    public function json_temp_persetujuan_keluarga_index(Request $request)
    {
        $data = TempPersetujuanKeluarga::where('session', $request->session)->get();

        $dpersetujuan_keluarga = array();
        foreach($data as $persetujuan_keluarga){
            $dpersetujuan_keluarga[] = array(
                'id' => $persetujuan_keluarga->id,
                'nama_persetujuan_keluarga' => $persetujuan_keluarga->persetujuan_keluarga->nama_persetujuan_keluarga,
                'nik' => $persetujuan_keluarga->persetujuan_keluarga->nik,
            );
        }

        return Datatables::of($dpersetujuan_keluarga)->make(true);
    }

    public function temp_persetujuan_keluarga_destroy(TempPersetujuanKeluarga $temp_persetujuan_keluarga, $id)
    {
        TempPersetujuanKeluarga::destroy($id);
    }
}
