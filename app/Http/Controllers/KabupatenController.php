<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Redirect, Response;
use Yajra\DataTables\DataTables;

class KabupatenController extends Controller
{
    public function index(Request $request)
    {
        return view('auths.kabupaten.index');
    }

    public function json_kabupaten_index(){
        $data = Kabupaten::all();

        $dkabupaten = array();
        foreach($data as $kabupaten){
            $dkabupaten[] = array(
                'id' => $kabupaten->id,
                'nama_kabupaten' => $kabupaten->nama_kabupaten,
            );
        }


        return Datatables::of($dkabupaten)->make(true);
    }

    public function json_kabupaten_edit(Request $request)
    {
        $kabupaten = Kabupaten::find($request->id);
        return response()->json($kabupaten);
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
        $kabupaten = new Kabupaten();
        $kabupaten->nama_kabupaten = $request->nama_kabupaten;
        $kabupaten->save();
        return response()->json($kabupaten); 
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
        
        $kabupaten = Kabupaten::find($id);
        $kabupaten->nama_kabupaten = $request->nama_kabupaten;
        $kabupaten->update();

        return response()->json($kabupaten);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kabupaten::destroy($id);
    }
}
