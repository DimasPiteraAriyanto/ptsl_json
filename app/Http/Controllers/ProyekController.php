<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use Illuminate\Http\Request;
use Redirect, Response;
use Yajra\DataTables\DataTables;

class ProyekController extends Controller
{
    public function index(Request $request)
    {
        return view('auths.proyek.index');
    }

    public function json_proyek_index(){
        $data = Proyek::all();

        $dproyek = array();
        foreach($data as $proyek){
            $dproyek[] = array(
                'id' => $proyek->id,
                'nama_proyek' => $proyek->nama_proyek,
                'tahun' => $proyek->tahun,
            );
        }


        return Datatables::of($dproyek)->make(true);
    }

    public function json_proyek_edit(Request $request)
    {
        $proyek = Proyek::find($request->id);
        return response()->json($proyek);
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
        $proyek = new Proyek();
        $proyek->nama_proyek = $request->nama_proyek;
        $proyek->tahun = $request->tahun;
        $proyek->save();
        return response()->json($proyek); 
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
        
        $proyek = Proyek::find($id);
        $proyek->nama_proyek = $request->nama_proyek;
        $proyek->tahun = $request->tahun;
        $proyek->update();

        return response()->json($proyek);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Proyek::destroy($id);
    }
}
