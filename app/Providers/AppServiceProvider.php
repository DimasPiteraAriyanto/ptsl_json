<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $pengguna = array(
            1 => 'Administrator',
            2 => 'Petugas Yuridis',
            3 => 'Petugas Pengukuran',
            4 => 'Petugas Desa',
        );

        $jabatan = array(
            1 => 'Ketua Panitia Ajudikasi',
            2 => 'Wakil Ketua Bidang Fisik',
            3 => 'Wakil Ketua Bidang Yuridis',
            4 => 'Sekretaris',
            5 => 'Anggota Panitia Ajudikasi (I)',
            6 => 'Anggota Panitia Ajudikasi (II)',
            7 => 'Anggota Panitia Ajudikasi (III)',
            8 => 'Anggota Panitia Ajudikasi (IVI)',
        );

        $dokumen = array(
            1 => 'Pemohon',
            2 => 'Bukti Alas Hak Tanah',
            3 => 'Persil',
            4 => 'Risalah',
        );

        $jenis_pemohon = array(
            1 => 'Perorangan',
            2 => 'Badan Hukum',
            3 => 'Pemerintah Kabupaten',
            4 => 'Pemerintah Desa',
            5 => 'BUMN',
        );

        View::share('pengguna', $pengguna);
        View::share('jabatan', $jabatan);
        View::share('dokumen', $dokumen);
        View::share('jenis_pemohon', $jenis_pemohon);
        Schema::defaultStringLength(191);
    }
}
