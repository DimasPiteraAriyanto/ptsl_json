<?php

namespace App\Http\Controllers;

use App\Models\Pemohon;
use App\Models\Berkas;
use App\Models\Proyek;
use App\Models\Penlok;
use App\Models\Desa;
use Illuminate\Http\Request;
use Redirect, Response;
use Yajra\DataTables\DataTables;

class PemohonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'index';
    }

    public function json_pemohon_index(Request $request){
        $pid = $request->pid;
        $nob = $request->nob;
        $doc = $request->doc;

        $jenis_pemohon = array(
            1 => 'Perorangan',
            2 => 'Badan Hukum',
            3 => 'Pemerintah Kabupaten',
            4 => 'Pemerintah Desa',
            5 => 'BUMN',
        );

        $data = Pemohon::where('penlok_id', $pid)
            ->where('nob', $nob)
            ->where('doc', $doc)
            ->get();

        $dpemohon = array();
        foreach($data as $pemohon){
            $dpemohon[] = array(
                'id' => $pemohon->id,
                'nama_pemohon' => $pemohon->nama_pemohon,
                'nik' => $pemohon->nik,
                'jenis_pemohon' => $jenis_pemohon[$pemohon->jenis_pemohon],
                'no_telp' => $pemohon->no_telp,
                'alamat' => $pemohon->desa." - ".$pemohon->kecamatan.", ".$pemohon->kabupaten,
            );
        }

        return Datatables::of($dpemohon)->make(true);
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
        $pemohon = new Pemohon();
        $pemohon->penlok_id = $request->pid;
        $pemohon->nob = $request->nob;
        $pemohon->doc = $request->doc;
        $pemohon->nik = $request->nik;
        $pemohon->no_telp = $request->no_telp;
        $pemohon->nama_pemohon = $request->nama_pemohon;
        $pemohon->tempat_lahir = $request->tempat_lahir;
        $pemohon->tanggal_lahir = $request->tanggal_lahir;
        $pemohon->pekerjaan = $request->pekerjaan;
        $pemohon->agama = $request->agama;
        $pemohon->jenis_kelamin = $request->jenis_kelamin;
        $pemohon->desa = $request->desa;
        $pemohon->kecamatan = $request->kecamatan;
        $pemohon->kabupaten = $request->kabupaten;
        $pemohon->jenis_pemohon = $request->jenis_pemohon;
        $pemohon->save();
        return response()->json($pemohon); 
    }

    public function json_pemohon_edit(Request $request)
    {
        $pemohon = Pemohon::find($request->id);
        return response()->json($pemohon);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemohon  $pemohon
     * @return \Illuminate\Http\Response
     */
    public function show(Pemohon $pemohon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemohon  $pemohon
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemohon $pemohon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemohon  $pemohon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemohon $pemohon)
    {
        $pemohon = Pemohon::find($pemohon->id);
        $pemohon->nik = $request->nik;
        $pemohon->no_telp = $request->no_telp;
        $pemohon->nama_pemohon = $request->nama_pemohon;
        $pemohon->tempat_lahir = $request->tempat_lahir;
        $pemohon->tanggal_lahir = $request->tanggal_lahir;
        $pemohon->pekerjaan = $request->pekerjaan;
        $pemohon->agama = $request->agama;
        $pemohon->jenis_kelamin = $request->jenis_kelamin;
        $pemohon->desa = $request->desa;
        $pemohon->kecamatan = $request->kecamatan;
        $pemohon->kabupaten = $request->kabupaten;
        $pemohon->jenis_pemohon = $request->jenis_pemohon;
        $pemohon->update();
        return response()->json($pemohon); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemohon  $pemohon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemohon $pemohon)
    {
        Pemohon::destroy($pemohon->id);
    }
}
