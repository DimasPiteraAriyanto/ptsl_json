<?php

namespace App\Http\Controllers;

use App\Models\AhliWaris;
use App\Models\Berkas;
use App\Models\Proyek;
use App\Models\TempAhliWaris;
use App\Models\Penlok;
use App\Models\Desa;
use Illuminate\Http\Request;
use Redirect, Response;
use Yajra\DataTables\DataTables;

class AhliWarisController extends Controller
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
        return view('auths.ahli-waris.index', compact(
            'pid',
            'nob',
            'doc',
        ));
    }

    public function json_ahli_waris_index(Request $request){
        $data = AhliWaris::orderBy('id', 'DESC')->get();

        $dahli_waris = array();
        foreach($data as $ahli_waris){
            $dahli_waris[] = array(
                'id' => $ahli_waris->id,
                'nama_ahli_waris' => $ahli_waris->nama_ahli_waris,
                'nik' => $ahli_waris->nik,
                'no_telp' => $ahli_waris->no_telp,
                'alamat' => $ahli_waris->desa." - ".$ahli_waris->kecamatan.", ".$ahli_waris->kabupaten,
            );
        }

        return Datatables::of($dahli_waris)->make(true);
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
        $ahli_waris = new AhliWaris();
        $ahli_waris->nik = $request->nik;
        $ahli_waris->no_telp = $request->no_telp;
        $ahli_waris->nama_ahli_waris = $request->nama_ahli_waris;
        $ahli_waris->tempat_lahir = $request->tempat_lahir;
        $ahli_waris->tanggal_lahir = $request->tanggal_lahir;
        $ahli_waris->pekerjaan = $request->pekerjaan;
        $ahli_waris->agama = $request->agama;
        $ahli_waris->jenis_kelamin = $request->jenis_kelamin;
        $ahli_waris->desa = $request->desa;
        $ahli_waris->kecamatan = $request->kecamatan;
        $ahli_waris->kabupaten = $request->kabupaten;
        $ahli_waris->save();
        return response()->json($ahli_waris); 
    }

    public function json_ahli_waris_edit(Request $request)
    {
        $ahli_waris = AhliWaris::find($request->id);
        return response()->json($ahli_waris);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AhliWaris  $ahli_waris
     * @return \Illuminate\Http\Response
     */
    public function show(AhliWaris $ahli_waris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AhliWaris  $ahli_waris
     * @return \Illuminate\Http\Response
     */
    public function edit(AhliWaris $ahli_waris)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AhliWaris  $ahli_waris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AhliWaris $ahli_waris, $id)
    {
        $ahli_waris = AhliWaris::find($id);
        $ahli_waris->nik = $request->nik;
        $ahli_waris->no_telp = $request->no_telp;
        $ahli_waris->nama_ahli_waris = $request->nama_ahli_waris;
        $ahli_waris->tempat_lahir = $request->tempat_lahir;
        $ahli_waris->tanggal_lahir = $request->tanggal_lahir;
        $ahli_waris->pekerjaan = $request->pekerjaan;
        $ahli_waris->agama = $request->agama;
        $ahli_waris->jenis_kelamin = $request->jenis_kelamin;
        $ahli_waris->desa = $request->desa;
        $ahli_waris->kecamatan = $request->kecamatan;
        $ahli_waris->kabupaten = $request->kabupaten;
        $ahli_waris->update();
        return response()->json($ahli_waris); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AhliWaris  $ahli_waris
     * @return \Illuminate\Http\Response
     */
    public function destroy(AhliWaris $ahli_waris, $id)
    {
        AhliWaris::destroy($id);
    }

    public function entri_ahli_waris(Request $request)
    {
        TempAhliWaris::create([
            'ahli_waris_id' => $request->id,
            'session' => $request->session,
        ]);
    }

    public function json_temp_ahli_waris_index(Request $request)
    {
        $data = TempAhliWaris::where('session', $request->session)->get();

        $dahli_waris = array();
        foreach($data as $ahli_waris){
            $dahli_waris[] = array(
                'id' => $ahli_waris->id,
                'nama_ahli_waris' => $ahli_waris->ahli_waris->nama_ahli_waris,
                'nik' => $ahli_waris->ahli_waris->nik,
            );
        }

        return Datatables::of($dahli_waris)->make(true);
    }

    public function temp_ahli_waris_destroy(TempAhliWaris $temp_ahli_waris, $id)
    {
        TempAhliWaris::destroy($id);
    }
}
