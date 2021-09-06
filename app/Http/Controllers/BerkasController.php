<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Proyek;
use App\Models\Penlok;
use App\Models\Desa;
use Illuminate\Http\Request;
use Redirect, Response;
use Yajra\DataTables\DataTables;

class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $max_persil = Penlok::max('jumlah_persil');
        $tahun = self::get_combine_proyek_value('tahun');
        $proyek = Proyek::all();
        $desa = Penlok::groupBy('desa_id')->get();
        return view('auths.berkas.index', compact(
            'max_persil',
            'tahun',
            'proyek',
            'desa',
        ));
    }

    public function get_combine_proyek_value($tahun)
    {
        $proyek = Proyek::all();
        foreach ($proyek as $p) {
            $tahun = $p->tahun;
        }

        return array($tahun);
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
        if ($request->input('desa_id') === 'null' && $request->input('tahun') === 'null' && $request->input('no_berkas') === 'null') {
            $penlok = Penlok::when($request->get('proyek_id'), function ($query, $proyek_id) {
                $query->where('proyek_id', $proyek_id);
            })
                ->get();
        } elseif ($request->input('proyek_id') === 'null' && $request->input('desa_id') === 'null' && $request->input('no_berkas') === 'null') {
            $penlok = Penlok::when($request->get('tahun'), function ($query, $tahun) {
                $query->whereYear('tanggal_sk_penlok', '=', $tahun);
            })
                ->get();
        } elseif ($request->input('proyek_id') === 'null' && $request->input('desa_id') === 'null' && $request->input('tahun') === 'null') {
            $penlok = Penlok::when($request->get('no_berkas'), function ($query, $no_berkas) {
                $query->where('jumlah_persil', '>=', $no_berkas);
            })
                ->get();
        } elseif ($request->input('proyek_id') === 'null' && $request->input('no_berkas') === 'null' && $request->input('tahun') === 'null') {
            $penlok = Penlok::when($request->get('desa_id'), function ($query, $desa_id) {
                $query->where('desa_id', $desa_id);
            })
                ->get();
        } elseif ($request->input('tahun') === 'null' && $request->input('desa_id') === 'null') {
            $penlok = Penlok::when($request->get('proyek_id'), function ($query, $proyek_id) {
                $query->where('proyek_id', $proyek_id);
            })
                ->when($request->get('no_berkas'), function ($query, $no_berkas) {
                    $query->where('jumlah_persil', '>=', $no_berkas);
                })
                ->get();
        } elseif ($request->input('proyek_id') === 'null') {
            $penlok = Penlok::when($request->get('desa_id'), function ($query, $desa_id) {
                $query->where('desa_id', $desa_id);
            })
                ->when($request->get('tahun'), function ($query, $tahun) {
                    $query->whereYear('tanggal_sk_penlok', '=', $tahun);
                })
                ->when($request->get('no_berkas'), function ($query, $no_berkas) {
                    $query->where('jumlah_persil', '>=', $no_berkas);
                })
                ->get();
        } elseif ($request->input('desa_id') === 'null') {
            $penlok = Penlok::when($request->get('proyek_id'), function ($query, $proyek_id) {
                $query->where('proyek_id', $proyek_id);
            })
                ->when($request->get('tahun'), function ($query, $tahun) {
                    $query->whereYear('tanggal_sk_penlok', '=', $tahun);
                })
                ->when($request->get('no_berkas'), function ($query, $no_berkas) {
                    $query->where('jumlah_persil', '>=', $no_berkas);
                })
                ->get();
        } elseif ($request->input('tahun') === 'null') {
            $penlok = Penlok::when($request->get('proyek_id'), function ($query, $proyek_id) {
                $query->where('proyek_id', $proyek_id);
            })
                ->when($request->get('desa_id'), function ($query, $desa_id) {
                    $query->where('desa_id', $desa_id);
                })
                ->when($request->get('no_berkas'), function ($query, $no_berkas) {
                    $query->where('jumlah_persil', '>=', $no_berkas);
                })
                ->get();
        } elseif ($request->input('no_berkas') === 'null') {
            $penlok = Penlok::when($request->get('proyek_id'), function ($query, $proyek_id) {
                $query->where('proyek_id', $proyek_id);
            })
                ->when($request->get('desa_id'), function ($query, $desa_id) {
                    $query->where('desa_id', $desa_id);
                })
                ->when($request->get('tahun'), function ($query, $tahun) {
                    $query->whereYear('tanggal_sk_penlok', '=', $tahun);
                })
                ->get();
        } else {
            $penlok = Penlok::when($request->get('proyek_id'), function ($query, $proyek_id) {
                $query->where('proyek_id', $proyek_id);
            })
                ->when($request->get('desa_id'), function ($query, $desa_id) {
                    $query->where('desa_id', $desa_id);
                })
                ->when($request->get('tahun'), function ($query, $tahun) {
                    $query->whereYear('tanggal_sk_penlok', '=', $tahun);
                })
                ->when($request->get('no_berkas'), function ($query, $no_berkas) {
                    $query->where('jumlah_persil', '>=', $no_berkas);
                })
                ->get();
        }

        $dberkas = array();
        foreach ($penlok as $penlok) {
            $id =  $penlok->id;
            $proyek_id =  $penlok->proyek_id;
            $jumlah_persil =  $penlok->jumlah_persil;
        }

        for ($i = 1; $i <= $jumlah_persil; $i++) {
            $dberkas[] = array(
                'id' => $id,
                'proyek_id' => $proyek_id,
                'no_berkas' => $i,
                'nub' => 'nub',
                'nama_pemohon' => 'nama_pemohon',
                'nik' => 'nik',
                'no_alas_hak' => 'no_alas_hak',
                'tanggal_alas_hak' => 'tanggal_alas_hak',
                'luas_pengukuran' => 'luas_pengukuran',
                'luas_yang_dimohon' => 'luas_yang_dimohon',
                'klaster' => 'klaster',
                'no_hp' => 'no_hp',
                'status_surat' => 'status_surat',
            );
        }

        return Datatables::of($dberkas)->make(true);
    }

    public function bstation(Request $request)
    {
        $pid = $request->pid;
        $nob = $request->nob;
        $penlok = Penlok::find($pid);
        return view('auths.berkas.station', compact('penlok', 'nob'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berkas  $berkas
     * @return \Illuminate\Http\Response
     */
    public function show(Berkas $berkas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berkas  $berkas
     * @return \Illuminate\Http\Response
     */
    public function edit(Berkas $berkas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berkas  $berkas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berkas $berkas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berkas  $berkas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berkas $berkas)
    {
        //
    }
}
