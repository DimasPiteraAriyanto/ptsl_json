<?php

namespace App\Http\Controllers;

use App\Models\Saksi;
use App\Models\Berkas;
use App\Models\Proyek;
use App\Models\TempSaksi;
use App\Models\Penlok;
use App\Models\Desa;
use Illuminate\Http\Request;
use Redirect, Response;
use Yajra\DataTables\DataTables;

class SaksiController extends Controller
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
        return view('auths.saksi.index', compact(
            'pid',
            'nob',
            'doc',
        ));
    }

    public function json_saksi_index(Request $request){
        $data = Saksi::orderBy('id', 'DESC')->get();

        $dsaksi = array();
        foreach($data as $saksi){
            $dsaksi[] = array(
                'id' => $saksi->id,
                'nama_saksi' => $saksi->nama_saksi,
                'nik' => $saksi->nik,
                'no_telp' => $saksi->no_telp,
                'alamat' => $saksi->desa." - ".$saksi->kecamatan.", ".$saksi->kabupaten,
            );
        }

        return Datatables::of($dsaksi)->make(true);
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
        $saksi = new Saksi();
        $saksi->nik = $request->nik;
        $saksi->no_telp = $request->no_telp;
        $saksi->nama_saksi = $request->nama_saksi;
        $saksi->tempat_lahir = $request->tempat_lahir;
        $saksi->tanggal_lahir = $request->tanggal_lahir;
        $saksi->pekerjaan = $request->pekerjaan;
        $saksi->agama = $request->agama;
        $saksi->jenis_kelamin = $request->jenis_kelamin;
        $saksi->desa = $request->desa;
        $saksi->kecamatan = $request->kecamatan;
        $saksi->kabupaten = $request->kabupaten;
        $saksi->save();
        return response()->json($saksi); 
    }

    public function json_saksi_edit(Request $request)
    {
        $saksi = Saksi::find($request->id);
        return response()->json($saksi);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Saksi  $saksi
     * @return \Illuminate\Http\Response
     */
    public function show(Saksi $saksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Saksi  $saksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Saksi $saksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Saksi  $saksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Saksi $saksi, $id)
    {
        $saksi = Saksi::find($id);
        $saksi->nik = $request->nik;
        $saksi->no_telp = $request->no_telp;
        $saksi->nama_saksi = $request->nama_saksi;
        $saksi->tempat_lahir = $request->tempat_lahir;
        $saksi->tanggal_lahir = $request->tanggal_lahir;
        $saksi->pekerjaan = $request->pekerjaan;
        $saksi->agama = $request->agama;
        $saksi->jenis_kelamin = $request->jenis_kelamin;
        $saksi->desa = $request->desa;
        $saksi->kecamatan = $request->kecamatan;
        $saksi->kabupaten = $request->kabupaten;
        $saksi->update();
        return response()->json($saksi); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Saksi  $saksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Saksi $saksi, $id)
    {
        Saksi::destroy($id);
    }

    public function entri_saksi(Request $request)
    {
        TempSaksi::create([
            'saksi_id' => $request->id,
            'session' => $request->session,
        ]);
    }

    public function json_temp_saksi_index(Request $request)
    {
        $data = TempSaksi::where('session', $request->session)->get();

        $dsaksi = array();
        foreach($data as $saksi){
            $dsaksi[] = array(
                'id' => $saksi->id,
                'nama_saksi' => $saksi->saksi->nama_saksi,
                'nik' => $saksi->saksi->nik,
            );
        }

        return Datatables::of($dsaksi)->make(true);
    }

    public function temp_saksi_destroy(TempSaksi $temp_saksi, $id)
    {
        TempSaksi::destroy($id);
    }
}
