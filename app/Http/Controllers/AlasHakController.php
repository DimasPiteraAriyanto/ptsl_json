<?php

namespace App\Http\Controllers;

use App\Models\AlasHak;
use Illuminate\Http\Request;

class AlasHakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alas = AlasHak::all();
        return compact('alas');
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
        AlasHak::create([
            'penlok_id' => $request->pid,
            'jenis_alas_hak_id' => $request->jid,
            'pemohon_id' => $request->pemohon_id,
            'nob' => $request->nob,
            'klaster' => $request->klaster,
            'status_surat' => $request->status_surat,
            'jenis_hak' => $request->jenis_hak,
            'nama_alas_hak' => $request->nama_alas_hak,
            'no_alas_hak' => $request->no_alas_hak,
            'tanggal_alas_hak' => $request->tanggal_alas_hak,
            'pembuat_alas_hak' => $request->pembuat_alas_hak,
            'luas_yang_dimohon' => $request->luas_yang_dimohon,
            'utara' => $request->utara,
            'timur' => $request->timur,
            'selatan' => $request->selatan,
            'barat' => $request->barat,
            'harga' => $request->harga,
            'nama_almarhum' => $request->nama_almarhum,
            'tanggal_meninggal' => $request->tanggal_meninggal,
            'desa_meninggal' => $request->desa_meninggal,
            'kecamatan_meninggal' => $request->kecamatan_meninggal,
            'kabupaten_meninggal' => $request->kabupaten_meninggal,
            'desa_tinggal' => $request->desa_tinggal,
            'kecamatan_tinggal' => $request->kecamatan_tinggal,
            'kabupaten_tinggal' => $request->kabupaten_tinggal,
            'perkawinan_dengan' => $request->perkawinan_dengan,
            'session' => $request->session,
        ]);

        return redirect(url(config('app.root') . '/berkas/' . $request->pid . '/' . $request->nob . '/' . $request->doc));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AlasHak  $alasHak
     * @return \Illuminate\Http\Response
     */
    public function show(AlasHak $alasHak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlasHak  $alasHak
     * @return \Illuminate\Http\Response
     */
    public function edit(AlasHak $alasHak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlasHak  $alasHak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AlasHak $alasHak)
    {
        AlasHak::where('id', $alasHak->id)
            ->update([
                'penlok_id' => $request->pid,
                'jenis_alas_hak_id' => $request->jid,
                'pemohon_id' => $request->pemohon_id,
                'nob' => $request->nob,
                'klaster' => $request->klaster,
                'status_surat' => $request->status_surat,
                'jenis_hak' => $request->jenis_hak,
                'nama_alas_hak' => $request->nama_alas_hak,
                'no_alas_hak' => $request->no_alas_hak,
                'tanggal_alas_hak' => $request->tanggal_alas_hak,
                'pembuat_alas_hak' => $request->pembuat_alas_hak,
                'luas_yang_dimohon' => $request->luas_yang_dimohon,
                'utara' => $request->utara,
                'timur' => $request->timur,
                'selatan' => $request->selatan,
                'barat' => $request->barat,
                'harga' => $request->harga,
                'nama_almarhum' => $request->nama_almarhum,
                'tanggal_meninggal' => $request->tanggal_meninggal,
                'desa_meninggal' => $request->desa_meninggal,
                'kecamatan_meninggal' => $request->kecamatan_meninggal,
                'kabupaten_meninggal' => $request->kabupaten_meninggal,
                'desa_tinggal' => $request->desa_tinggal,
                'kecamatan_tinggal' => $request->kecamatan_tinggal,
                'kabupaten_tinggal' => $request->kabupaten_tinggal,
                'perkawinan_dengan' => $request->perkawinan_dengan,
                'session' => $request->session,
            ]);

        return redirect(url(config('app.root') . '/berkas/' . $request->pid . '/' . $request->nob . '/' . $request->doc));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlasHak  $alasHak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        AlasHak::destroy($id);
    }
}
