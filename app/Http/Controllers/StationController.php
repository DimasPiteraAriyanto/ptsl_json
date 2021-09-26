<?php

namespace App\Http\Controllers;

use App\Models\Pemohon;
use App\Models\Berkas;
use App\Models\Proyek;
use App\Models\Penlok;
use App\Models\Desa;
use App\Models\AlasHak;
use App\Models\JenisAlasHak;
use Illuminate\Http\Request;
use Redirect, Response;
use Yajra\DataTables\DataTables;

class StationController extends Controller
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
        $penlok = Penlok::find($pid);

        if($doc == 1){
            return view('auths.pemohon.index', compact('pid','nob','doc','penlok'));
        }elseif($doc == 2){
            $alas_hak = AlasHak::orderBy('id', 'DESC')
                ->where('penlok_id', $pid)
                ->where('nob', $nob)
                ->get();

            return view('auths.alas-hak.index', compact(
                'pid',
                'nob',
                'doc',
                'penlok',
                'alas_hak',
            ));
        }elseif($doc == 3){
            return view('auths.persil.index', compact('pid','nob','doc','penlok'));
            $alas_hak = AlasHak::orderBy('id', 'DESC')
            ->where('penlok_id', $pid)
            ->where('nob', $nob)
            ->get();

            return view('auths.alas-hak.index', compact(
            'pid',
            'nob',
            'doc',
            'penlok',
            'alas_hak',));
    }}

    public function alas_hak_post(Request $request)
    {
        // WARNING
        return redirect(url()->current().'/create/'.$request->jenis_alas_hak_id);
    }

    public function alas_hak_station(Request $request)
    {
        $pid = $request->pid;
        $nob = $request->nob;
        $doc = $request->doc;
        $penlok = Penlok::find($pid);
        $jenis_alas_hak = JenisAlasHak::all();
        return view('auths.station.add_jenis_alas_hak', compact(
            'pid',
            'nob',
            'doc',
            'penlok',
            'jenis_alas_hak'
        ));
    }

    public function alas_hak_create(Request $request)
    {
        $pid = $request->pid;
        $nob = $request->nob;
        $doc = $request->doc;
        $jid = $request->jid;
        $penlok = Penlok::find($pid);
        $jenis_alas_hak = JenisAlasHak::find($jid);
        $pemohon = Pemohon::where('penlok_id', $pid)
            ->where('nob', $nob)
            ->get();

        $session = rand(11111111,99999999);
        return view('auths.alas-hak.create', compact(
            'pid',
            'nob',
            'doc',
            'penlok',
            'jenis_alas_hak',
            'jid',
            'pemohon',
            'session'
        ));
    }

    public function alas_hak_edit(Request $request)
    {
        $pid = $request->pid;
        $nob = $request->nob;
        $doc = $request->doc;
        $jid = $request->jid;
        $session = $request->session;

        $penlok = Penlok::find($pid);
        $jenis_alas_hak = JenisAlasHak::find($jid);
        $pemohon = Pemohon::where('penlok_id', $pid)
            ->where('nob', $nob)
            ->get();

        $alas_hak = AlasHak::where('session', $session)->first();
        return view('auths.alas-hak.edit', compact(
            'pid',
            'nob',
            'doc',
            'penlok',
            'jenis_alas_hak',
            'jid',
            'pemohon',
            'session',
            'alas_hak'
        ));
    }

    public function alas_hak_view(Request $request)
    {
        $pid = $request->pid;
        $nob = $request->nob;
        $doc = $request->doc;
        $jid = $request->jid;
        $session = $request->session;

        $penlok = Penlok::find($pid);
        $jenis_alas_hak = JenisAlasHak::find($jid);
        $pemohon = Pemohon::where('penlok_id', $pid)
            ->where('nob', $nob)
            ->get();

        $alas_hak = AlasHak::where('session', $session)->first();
        return view('auths.alas-hak.view', compact(
            'pid',
            'nob',
            'doc',
            'penlok',
            'jenis_alas_hak',
            'jid',
            'pemohon',
            'session',
            'alas_hak'
        ));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
