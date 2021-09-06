<?php

namespace App\Http\Controllers;

use App\Models\PihakPertama;
use App\Models\Berkas;
use App\Models\Proyek;
use App\Models\TempPihakPertama;
use App\Models\Penlok;
use App\Models\Desa;
use Illuminate\Http\Request;
use Redirect, Response;
use Yajra\DataTables\DataTables;

class PihakPertamaController extends Controller
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
        return view('auths.pihak-pertama.index', compact(
            'pid',
            'nob',
            'doc',
        ));
    }

    public function json_pihak_pertama_index(Request $request){
        $data = PihakPertama::orderBy('id', 'DESC')->get();

        $dpihak_pertama = array();
        foreach($data as $pihak_pertama){
            $dpihak_pertama[] = array(
                'id' => $pihak_pertama->id,
                'nama_pihak_pertama' => $pihak_pertama->nama_pihak_pertama,
                'nik' => $pihak_pertama->nik,
                'no_telp' => $pihak_pertama->no_telp,
                'alamat' => $pihak_pertama->desa." - ".$pihak_pertama->kecamatan.", ".$pihak_pertama->kabupaten,
            );
        }

        return Datatables::of($dpihak_pertama)->make(true);
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
        $pihak_pertama = new PihakPertama();
        $pihak_pertama->nik = $request->nik;
        $pihak_pertama->no_telp = $request->no_telp;
        $pihak_pertama->nama_pihak_pertama = $request->nama_pihak_pertama;
        $pihak_pertama->tempat_lahir = $request->tempat_lahir;
        $pihak_pertama->tanggal_lahir = $request->tanggal_lahir;
        $pihak_pertama->pekerjaan = $request->pekerjaan;
        $pihak_pertama->agama = $request->agama;
        $pihak_pertama->jenis_kelamin = $request->jenis_kelamin;
        $pihak_pertama->desa = $request->desa;
        $pihak_pertama->kecamatan = $request->kecamatan;
        $pihak_pertama->kabupaten = $request->kabupaten;
        $pihak_pertama->save();
        return response()->json($pihak_pertama); 
    }

    public function json_pihak_pertama_edit(Request $request)
    {
        $pihak_pertama = PihakPertama::find($request->id);
        return response()->json($pihak_pertama);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PihakPertama  $pihak_pertama
     * @return \Illuminate\Http\Response
     */
    public function show(PihakPertama $pihak_pertama)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PihakPertama  $pihak_pertama
     * @return \Illuminate\Http\Response
     */
    public function edit(PihakPertama $pihak_pertama)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PihakPertama  $pihak_pertama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PihakPertama $pihak_pertama, $id)
    {
        $pihak_pertama = PihakPertama::find($id);
        $pihak_pertama->nik = $request->nik;
        $pihak_pertama->no_telp = $request->no_telp;
        $pihak_pertama->nama_pihak_pertama = $request->nama_pihak_pertama;
        $pihak_pertama->tempat_lahir = $request->tempat_lahir;
        $pihak_pertama->tanggal_lahir = $request->tanggal_lahir;
        $pihak_pertama->pekerjaan = $request->pekerjaan;
        $pihak_pertama->agama = $request->agama;
        $pihak_pertama->jenis_kelamin = $request->jenis_kelamin;
        $pihak_pertama->desa = $request->desa;
        $pihak_pertama->kecamatan = $request->kecamatan;
        $pihak_pertama->kabupaten = $request->kabupaten;
        $pihak_pertama->update();
        return response()->json($pihak_pertama); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PihakPertama  $pihak_pertama
     * @return \Illuminate\Http\Response
     */
    public function destroy(PihakPertama $pihak_pertama, $id)
    {
        PihakPertama::destroy($id);
    }

    public function entri_pihak_pertama(Request $request)
    {
        TempPihakPertama::create([
            'pihak_pertama_id' => $request->id,
            'session' => $request->session,
        ]);
    }

    public function json_temp_pihak_pertama_index(Request $request)
    {
        $data = TempPihakPertama::where('session', $request->session)->get();

        $dpihak_pertama = array();
        foreach($data as $pihak_pertama){
            $dpihak_pertama[] = array(
                'id' => $pihak_pertama->id,
                'nama_pihak_pertama' => $pihak_pertama->pihak_pertama->nama_pihak_pertama,
                'nik' => $pihak_pertama->pihak_pertama->nik,
            );
        }

        return Datatables::of($dpihak_pertama)->make(true);
    }

    public function temp_pihak_pertama_destroy(TempPihakPertama $temp_pihak_pertama, $id)
    {
        TempPihakPertama::destroy($id);
    }
}
