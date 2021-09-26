<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlasHak;
use App\Models\Pemohon;
use App\Models\Ajudikasi;
use App\Models\Penlok;
use App\Models\Persil;
use Redirect, Response;
use Yajra\DataTables\DataTables;

class PersilController extends Controller
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

    public function json_persil_index(Request $request){
        $pid = $request->pid;
        $nob = $request->nob;
        $doc = $request->doc;
        $alas_hak = AlasHak::all();
        $pemohon = Pemohon::all();
        $ajudikasi = Ajudikasi::all();
        return view('auths.persil.index', compact('alas_hak','ajudikasi','pemohon'));



        $data = Persil::where('penlok_id', $pid)
            ->where('nob', $nob)
            ->where('doc', $doc)
            ->get();

        $dpersil = array();
        foreach($data as $persil){
            $dpersil[] = array(
                'id' => $persil->id,
                'pemohon_id' => $persil->pemohon->nama_pemohon,
                'alas_hak_id' => $persil->alas_hak->klaster,
                'nub' => $persil->nub,
                'luas_pengukuran' => $persil->luas_pengukuran,
                'penggunaan_tanah' => $persil->penggunaan_tanah,
                'tanda_batas' => $persil->tanda_batas,
                'no_pbt' => $persil->no_pbt,
                'no_gu' => $persil->no_gu,
                'no_berkas_fisik' => $persil->no_berkas_fisik,
                'nib' => $persil->nib,
                'ajudikasi_id' => $persil->ajudikasi->nama_pegawai,
            );
        }

        return Datatables::of($dpersil)->make(true);
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
        $persil = new Persil();
        $persil->penlok_id = $request->pid;
        $persil->ajudikasi_id = $request->ajudikasi_id;
        $persil->alas_hak_id = $request->alas_hak_id;
        $persil->pemohon_id = $request->pemohon_id;
        $persil->nob = $request->nob;
        $persil->doc = $request->doc;
        $persil->luas_pengukuran = $request->luas_pengukuran;
        $persil->penggunaan_tanah = $request->penggunaan_tanah;
        $persil->tanda_batas = $request->tanda_batas;
        $persil->no_pbt = $request->no_pbt;
        $persil->no_gu = $request->no_gu;
        $persil->no_berkas_fisik = $request->no_berkas_fisik;
        $persil->nib = $request->nib;
        $persil->save();
        return response()->json($persil);
    }

    public function json_persil_edit(Request $request)
    {
        $persil = Persil::find($request->id);
        return response()->json($persil);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemohon  $pemohon
     * @return \Illuminate\Http\Response
     */
    public function show(Persil $persil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemohon  $pemohon
     * @return \Illuminate\Http\Response
     */
    public function edit(Persil $persil)
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
    public function update(Request $request, Persil $persil)
    {
        $persil = Persil::find($persil->id);
        $$persil->penlok_id = $request->pid;
        $persil->ajudikasi_id = $request->ajudikasi_id;
        $persil->alas_hak_id = $request->alas_hak_id;
        $persil->pemohon_id = $request->pemohon_id;
        $persil->nob = $request->nob;
        $persil->doc = $request->doc;
        $persil->luas_pengukuran = $request->luas_pengukuran;
        $persil->penggunaan_tanah = $request->penggunaan_tanah;
        $persil->tanda_batas = $request->tanda_batas;
        $persil->no_pbt = $request->no_pbt;
        $persil->no_gu = $request->no_gu;
        $persil->no_berkas_fisik = $request->no_berkas_fisik;
        $persil->nib = $request->nib;
        return response()->json($persil);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemohon  $pemohon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persil $persil)
    {
        Persil::destroy($persil->id);
    }
}
