<?php

namespace App\Http\Controllers;

use App\Models\PenerimaKuasa;
use App\Models\Berkas;
use App\Models\Proyek;
use App\Models\TempPenerimaKuasa;
use App\Models\Penlok;
use App\Models\Desa;
use Illuminate\Http\Request;
use Redirect, Response;
use Yajra\DataTables\DataTables;

class PenerimaKuasaController extends Controller
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
        return view('auths.penerima-kuasa.index', compact(
            'pid',
            'nob',
            'doc',
        ));
    }

    public function json_penerima_kuasa_index(Request $request){
        $data = PenerimaKuasa::orderBy('id', 'DESC')->get();

        $dpenerima_kuasa = array();
        foreach($data as $penerima_kuasa){
            $dpenerima_kuasa[] = array(
                'id' => $penerima_kuasa->id,
                'nama_penerima_kuasa' => $penerima_kuasa->nama_penerima_kuasa,
                'nik' => $penerima_kuasa->nik,
                'no_telp' => $penerima_kuasa->no_telp,
                'alamat' => $penerima_kuasa->desa." - ".$penerima_kuasa->kecamatan.", ".$penerima_kuasa->kabupaten,
            );
        }

        return Datatables::of($dpenerima_kuasa)->make(true);
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
        $penerima_kuasa = new PenerimaKuasa();
        $penerima_kuasa->nik = $request->nik;
        $penerima_kuasa->no_telp = $request->no_telp;
        $penerima_kuasa->nama_penerima_kuasa = $request->nama_penerima_kuasa;
        $penerima_kuasa->tempat_lahir = $request->tempat_lahir;
        $penerima_kuasa->tanggal_lahir = $request->tanggal_lahir;
        $penerima_kuasa->pekerjaan = $request->pekerjaan;
        $penerima_kuasa->agama = $request->agama;
        $penerima_kuasa->jenis_kelamin = $request->jenis_kelamin;
        $penerima_kuasa->desa = $request->desa;
        $penerima_kuasa->kecamatan = $request->kecamatan;
        $penerima_kuasa->kabupaten = $request->kabupaten;
        $penerima_kuasa->save();
        return response()->json($penerima_kuasa); 
    }

    public function json_penerima_kuasa_edit(Request $request)
    {
        $penerima_kuasa = PenerimaKuasa::find($request->id);
        return response()->json($penerima_kuasa);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PenerimaKuasa  $penerima_kuasa
     * @return \Illuminate\Http\Response
     */
    public function show(PenerimaKuasa $penerima_kuasa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PenerimaKuasa  $penerima_kuasa
     * @return \Illuminate\Http\Response
     */
    public function edit(PenerimaKuasa $penerima_kuasa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PenerimaKuasa  $penerima_kuasa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenerimaKuasa $penerima_kuasa, $id)
    {
        $penerima_kuasa = PenerimaKuasa::find($id);
        $penerima_kuasa->nik = $request->nik;
        $penerima_kuasa->no_telp = $request->no_telp;
        $penerima_kuasa->nama_penerima_kuasa = $request->nama_penerima_kuasa;
        $penerima_kuasa->tempat_lahir = $request->tempat_lahir;
        $penerima_kuasa->tanggal_lahir = $request->tanggal_lahir;
        $penerima_kuasa->pekerjaan = $request->pekerjaan;
        $penerima_kuasa->agama = $request->agama;
        $penerima_kuasa->jenis_kelamin = $request->jenis_kelamin;
        $penerima_kuasa->desa = $request->desa;
        $penerima_kuasa->kecamatan = $request->kecamatan;
        $penerima_kuasa->kabupaten = $request->kabupaten;
        $penerima_kuasa->update();
        return response()->json($penerima_kuasa); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PenerimaKuasa  $penerima_kuasa
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenerimaKuasa $penerima_kuasa, $id)
    {
        PenerimaKuasa::destroy($id);
    }

    public function entri_penerima_kuasa(Request $request)
    {
        TempPenerimaKuasa::create([
            'penerima_kuasa_id' => $request->id,
            'session' => $request->session,
        ]);
    }

    public function json_temp_penerima_kuasa_index(Request $request)
    {
        $data = TempPenerimaKuasa::where('session', $request->session)->get();

        $dpenerima_kuasa = array();
        foreach($data as $penerima_kuasa){
            $dpenerima_kuasa[] = array(
                'id' => $penerima_kuasa->id,
                'nama_penerima_kuasa' => $penerima_kuasa->penerima_kuasa->nama_penerima_kuasa,
                'nik' => $penerima_kuasa->penerima_kuasa->nik,
            );
        }

        return Datatables::of($dpenerima_kuasa)->make(true);
    }

    public function temp_penerima_kuasa_destroy(TempPenerimaKuasa $temp_penerima_kuasa, $id)
    {
        TempPenerimaKuasa::destroy($id);
    }
}
