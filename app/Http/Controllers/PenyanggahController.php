<?php

namespace App\Http\Controllers;

use App\Models\Penyanggah;
use App\Models\Berkas;
use App\Models\Proyek;
use App\Models\TempPenyanggah;
use App\Models\Penlok;
use App\Models\Desa;
use Illuminate\Http\Request;
use Redirect, Response;
use Yajra\DataTables\DataTables;

class PenyanggahController extends Controller
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
        return view('auths.penyanggah.index', compact(
            'pid',
            'nob',
            'doc',
        ));
    }

    public function json_penyanggah_index(Request $request){
        $data = Penyanggah::orderBy('id', 'DESC')->get();

        $dpenyanggah = array();
        foreach($data as $penyanggah){
            $dpenyanggah[] = array(
                'id' => $penyanggah->id,
                'nama_penyanggah' => $penyanggah->nama_penyanggah,
                'nik' => $penyanggah->nik,
                'no_telp' => $penyanggah->no_telp,
                'alamat' => $penyanggah->desa." - ".$penyanggah->kecamatan.", ".$penyanggah->kabupaten,
            );
        }

        return Datatables::of($dpenyanggah)->make(true);
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
        $penyanggah = new Penyanggah();
        $penyanggah->nik = $request->nik;
        $penyanggah->no_telp = $request->no_telp;
        $penyanggah->nama_penyanggah = $request->nama_penyanggah;
        $penyanggah->tempat_lahir = $request->tempat_lahir;
        $penyanggah->tanggal_lahir = $request->tanggal_lahir;
        $penyanggah->pekerjaan = $request->pekerjaan;
        $penyanggah->agama = $request->agama;
        $penyanggah->jenis_kelamin = $request->jenis_kelamin;
        $penyanggah->desa = $request->desa;
        $penyanggah->kecamatan = $request->kecamatan;
        $penyanggah->kabupaten = $request->kabupaten;
        $penyanggah->save();
        return response()->json($penyanggah); 
    }

    public function json_penyanggah_edit(Request $request)
    {
        $penyanggah = Penyanggah::find($request->id);
        return response()->json($penyanggah);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penyanggah  $penyanggah
     * @return \Illuminate\Http\Response
     */
    public function show(Penyanggah $penyanggah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penyanggah  $penyanggah
     * @return \Illuminate\Http\Response
     */
    public function edit(Penyanggah $penyanggah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penyanggah  $penyanggah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penyanggah $penyanggah, $id)
    {
        $penyanggah = Penyanggah::find($id);
        $penyanggah->nik = $request->nik;
        $penyanggah->no_telp = $request->no_telp;
        $penyanggah->nama_penyanggah = $request->nama_penyanggah;
        $penyanggah->tempat_lahir = $request->tempat_lahir;
        $penyanggah->tanggal_lahir = $request->tanggal_lahir;
        $penyanggah->pekerjaan = $request->pekerjaan;
        $penyanggah->agama = $request->agama;
        $penyanggah->jenis_kelamin = $request->jenis_kelamin;
        $penyanggah->desa = $request->desa;
        $penyanggah->kecamatan = $request->kecamatan;
        $penyanggah->kabupaten = $request->kabupaten;
        $penyanggah->update();
        return response()->json($penyanggah); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penyanggah  $penyanggah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penyanggah $penyanggah, $id)
    {
        Penyanggah::destroy($id);
    }

    public function entri_penyanggah(Request $request)
    {
        TempPenyanggah::create([
            'penyanggah_id' => $request->id,
            'session' => $request->session,
        ]);
    }

    public function json_temp_penyanggah_index(Request $request)
    {
        $data = TempPenyanggah::where('session', $request->session)->get();

        $dpenyanggah = array();
        foreach($data as $penyanggah){
            $dpenyanggah[] = array(
                'id' => $penyanggah->id,
                'nama_penyanggah' => $penyanggah->penyanggah->nama_penyanggah,
                'nik' => $penyanggah->penyanggah->nik,
            );
        }

        return Datatables::of($dpenyanggah)->make(true);
    }

    public function temp_penyanggah_destroy(TempPenyanggah $temp_penyanggah, $id)
    {
        TempPenyanggah::destroy($id);
    }
}
