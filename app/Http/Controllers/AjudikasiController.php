<?php

namespace App\Http\Controllers;

use App\Models\Ajudikasi;
use App\Models\Proyek;
use App\Models\Desa;
use Illuminate\Http\Request;
use Redirect, Response;
use Yajra\DataTables\DataTables;

class AjudikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $proyek = Proyek::all();
        return view('auths.ajudikasi.index', compact('proyek'));
    }

    public function json_ajudikasi_index()
    {
        $data = Ajudikasi::all();

        $jabatan_ajudikasi = array(
            1 => 'Ketua Panitia Ajudikasi',
            2 => 'Wakil Ketua Bidang Fisik',
            3 => 'Wakil Ketua Bidang Yuridis',
            4 => 'Sekretaris',
            5 => 'Anggota Panitia Ajudikasi (I)',
            6 => 'Anggota Panitia Ajudikasi (II)',
            7 => 'Anggota Panitia Ajudikasi (III)',
            8 => 'Anggota Panitia Ajudikasi (IVI)',
        );

        $dajudikasi = array();
        foreach ($data as $ajudikasi) {
            $dajudikasi[] = array(
                'id' => $ajudikasi->id,
                'proyek_id' => $ajudikasi->proyek->nama_proyek,
                'nip' => $ajudikasi->nip,
                'nama_pegawai' => $ajudikasi->nama_pegawai,
                'golongan' => $ajudikasi->golongan,
                'jabatan_ajudikasi' => $jabatan_ajudikasi[$ajudikasi->jabatan_ajudikasi],
            );
        }

        return Datatables::of($dajudikasi)->make(true);
    }

    public function json_ajudikasi_edit(Request $request)
    {
        $ajudikasi = Ajudikasi::find($request->id);
        return response()->json($ajudikasi);
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
        $ajudikasi = new Ajudikasi();
        $ajudikasi->proyek_id = $request->proyek_id;
        $ajudikasi->nip = $request->nip;
        $ajudikasi->nama_pegawai = $request->nama_pegawai;
        $ajudikasi->golongan = $request->golongan;
        $ajudikasi->jabatan_ajudikasi = $request->jabatan_ajudikasi;
        $ajudikasi->save();
        return response()->json($ajudikasi);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ajudikasi = Ajudikasi::find($id);
        $ajudikasi->proyek_id = $request->proyek_id;
        $ajudikasi->nip = $request->nip;
        $ajudikasi->nama_pegawai = $request->nama_pegawai;
        $ajudikasi->golongan = $request->golongan;
        $ajudikasi->jabatan_ajudikasi = $request->jabatan_ajudikasi;
        $ajudikasi->update();

        return response()->json($ajudikasi);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ajudikasi::destroy($id);
    }
}
