<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kabupaten;
use App\Models\Desa;
use Illuminate\Http\Request;
use Redirect, Response;
use Yajra\DataTables\DataTables;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $kabupaten = Kabupaten::all();
        return view('auths.kecamatan.index', compact('kabupaten'));
    }

    public function json_kecamatan_index(){
        $data = Kecamatan::all();

        $dkecamatan = array();
        foreach($data as $kecamatan){
            $dkecamatan[] = array(
                'id' => $kecamatan->id,
                'kabupaten_id' => $kecamatan->kabupaten->nama_kabupaten,
                'nama_kecamatan' => $kecamatan->nama_kecamatan,
            );
        }

        return Datatables::of($dkecamatan)->make(true);
    }

    public function json_kecamatan_edit(Request $request)
    {
        $kecamatan = Kecamatan::find($request->id);
        return response()->json($kecamatan);
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
        $kecamatan = new Kecamatan();
        $kecamatan->kabupaten_id = $request->kabupaten_id;
        $kecamatan->nama_kecamatan = $request->nama_kecamatan;
        $kecamatan->save();
        return response()->json($kecamatan); 
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
        $kecamatan = Kecamatan::find($id);
        $kecamatan->kabupaten_id = $request->kabupaten_id;
        $kecamatan->nama_kecamatan = $request->nama_kecamatan;
        $kecamatan->update();

        return response()->json($kecamatan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kecamatan::destroy($id);
    }
}
