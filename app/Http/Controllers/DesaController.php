<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Redirect, Response;
use Yajra\DataTables\DataTables;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $kecamatan = Kecamatan::all();
        return view('auths.desa.index', compact('kecamatan'));
    }

    public function json_desa_index(){
        $data = Desa::all();
        $ddesa = array();
        foreach($data as $desa){
            $ddesa[] = array(
                'id' => $desa->id,
                'kecamatan_id' => $desa->kecamatan->nama_kecamatan,
                'kode_desa' => $desa->kode_desa,
                'nama_desa' => $desa->nama_desa,
                'reje_kampung' => $desa->reje_kampung,
                'nama_camat' => $desa->nama_camat,
                'nip' => $desa->nip,
                'alamat' => $desa->alamat,
                'kode_pos' => $desa->kode_pos,
            );
        }

        return Datatables::of($ddesa)->make(true);
    }

    public function json_desa_edit(Request $request)
    {
        $desa = Desa::find($request->id);
        return response()->json($desa);
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
        $desa = new Desa();
        $desa->kecamatan_id = $request->kecamatan_id;
        $desa->kode_desa = $request->kode_desa;
        $desa->nama_desa = $request->nama_desa;
        $desa->reje_kampung = $request->reje_kampung;
        $desa->nama_camat = $request->nama_camat;
        $desa->nip = $request->nip;
        $desa->alamat = $request->alamat;
        $desa->kode_pos = $request->kode_pos;
        $desa->save();
        return response()->json($desa); 
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
        $desa = Desa::find($id);
        $desa->kecamatan_id = $request->kecamatan_id;
        $desa->kode_desa = $request->kode_desa;
        $desa->nama_desa = $request->nama_desa;
        $desa->reje_kampung = $request->reje_kampung;
        $desa->nama_camat = $request->nama_camat;
        $desa->nip = $request->nip;
        $desa->alamat = $request->alamat;
        $desa->kode_pos = $request->kode_pos;
        $desa->update();

        return response()->json($desa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Desa::destroy($id);
    }
}
