<?php

namespace App\Http\Controllers;

use App\Models\Penlok;
use App\Models\Proyek;
use App\Models\Desa;
use Illuminate\Http\Request;
use Redirect, Response;
use Yajra\DataTables\DataTables;

class PenlokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $desa = Desa::all();
        $proyek = Proyek::all();
        return view('auths.penlok.index', compact('proyek','desa'));
    }

    public function json_penlok_index(){
        $data = Penlok::all();
        $dpenlok = array();
        foreach($data as $penlok){
            $dpenlok[] = array(
                'id' => $penlok->id,
                'proyek_id' => $penlok->proyek->nama_proyek,
                'desa_id' => $penlok->desa->nama_desa,
                'jumlah_persil' => $penlok->jumlah_persil,
                'no_sk_penlok' => $penlok->no_sk_penlok,
                'tanggal_sk_penlok' => $penlok->tanggal_sk_penlok->format('Y-m-d'),
            );
        }

        return Datatables::of($dpenlok)->make(true);
    }

    public function json_penlok_edit(Request $request)
    {
        $penlok = Penlok::find($request->id);
        return response()->json($penlok);
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
        $penlok = new Penlok();
        $penlok->proyek_id = $request->proyek_id;
        $penlok->desa_id = $request->desa_id;
        $penlok->jumlah_persil = $request->jumlah_persil;
        $penlok->no_sk_penlok = $request->no_sk_penlok;
        $penlok->tanggal_sk_penlok = $request->tanggal_sk_penlok;
        $penlok->save();
        return response()->json($penlok); 
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
        $penlok = Penlok::find($id);
        $penlok->proyek_id = $request->proyek_id;
        $penlok->desa_id = $request->desa_id;
        $penlok->jumlah_persil = $request->jumlah_persil;
        $penlok->no_sk_penlok = $request->no_sk_penlok;
        $penlok->tanggal_sk_penlok = $request->tanggal_sk_penlok;
        $penlok->update();
        return response()->json($penlok);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Penlok::destroy($id);
    }
}
