<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* Login View */

Route::get('/', function () {
    return view('auths.login');
})->name('login');

Route::post('/postlogin', 'LoginController@postlogin')->name('postlogin');
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth', 'ceklevel:1']], function () {
    Route::get(config('app.root') . '/dashboard', function () {
        return view('auths.dashboard');
    })->name('298338/dashboard');

    /* Role Permission => Akses Admin Dan User/Pegawai */

    Route::get(config('app.root') . '/json/users/{id}', 'UsersController@json_user_edit');
    Route::post(config('app.root') . '/json/users', 'UsersController@json_user_index');
    Route::resource(config('app.root') . '/users', 'UsersController', [
        'names' => [
            'index' => 'users',
            'create' => 'users.create',
            'store' => 'users.store',
        ]
    ]);

    Route::get(config('app.root') . '/json/kabupaten/{id}', 'KabupatenController@json_kabupaten_edit');
    Route::post(config('app.root') . '/json/kabupaten', 'KabupatenController@json_kabupaten_index');
    Route::resource(config('app.root') . '/kabupaten', 'KabupatenController', [
        'names' => [
            'index' => 'kabupaten',
            'create' => 'kabupaten.create',
            'store' => 'kabupaten.store',
        ]
    ]);

    Route::get(config('app.root') . '/json/kecamatan/{id}', 'KecamatanController@json_kecamatan_edit');
    Route::post(config('app.root') . '/json/kecamatan', 'KecamatanController@json_kecamatan_index');
    Route::resource(config('app.root') . '/kecamatan', 'KecamatanController', [
        'names' => [
            'index' => 'kecamatan',
            'create' => 'kecamatan.create',
            'store' => 'kecamatan.store',
        ]
    ]);

    Route::get(config('app.root') . '/json/ajudikasi/{id}', 'AjudikasiController@json_ajudikasi_edit');
    Route::post(config('app.root') . '/json/ajudikasi', 'AjudikasiController@json_ajudikasi_index');
    Route::resource(config('app.root') . '/ajudikasi', 'AjudikasiController', [
        'names' => [
            'index' => 'ajudikasi',
            'create' => 'ajudikasi.create',
            'store' => 'ajudikasi.store',
        ]
    ]);

    Route::get(config('app.root') . '/json/desa/{id}', 'DesaController@json_desa_edit');
    Route::post(config('app.root') . '/json/desa', 'DesaController@json_desa_index');
    Route::resource(config('app.root') . '/desa', 'DesaController', [
        'names' => [
            'index' => 'desa',
            'create' => 'desa.create',
            'store' => 'desa.store',
        ]
    ]);

    Route::get(config('app.root') . '/json/proyek/{id}', 'ProyekController@json_proyek_edit');
    Route::post(config('app.root') . '/json/proyek', 'ProyekController@json_proyek_index');
    Route::resource(config('app.root') . '/proyek', 'ProyekController', [
        'names' => [
            'index' => 'proyek',
            'create' => 'proyek.create',
            'store' => 'proyek.store',
        ]
    ]);

    Route::get(config('app.root') . '/json/penlok/{id}', 'PenlokController@json_penlok_edit');
    Route::post(config('app.root') . '/json/penlok', 'PenlokController@json_penlok_index');
    Route::resource(config('app.root') . '/penlok', 'PenlokController', [
        'names' => [
            'index' => 'penlok',
            'create' => 'penlok.create',
            'store' => 'penlok.store',
        ]
    ]);

    Route::get(config('app.root') . '/berkas/{pid}/{nob}', 'BerkasController@bstation');
    Route::resource(config('app.root') . '/berkas', 'BerkasController', [
        'names' => [
            'index' => 'berkas',
        ]
    ]);

    /** The station here **/
    Route::get(config('app.root') . '/berkas/{pid}/{nob}/{doc}', 'StationController@index');
    Route::post(config('app.root') . '/berkas/{pid}/{nob}/{doc}', 'StationController@alas_hak_post');
    Route::get(config('app.root') . '/berkas/{pid}/{nob}/{doc}/create', 'StationController@alas_hak_station');
    Route::get(config('app.root') . '/berkas/{pid}/{nob}/{doc}/create/{jid}', 'StationController@alas_hak_create');
    Route::get(config('app.root') . '/berkas/{pid}/{nob}/{doc}/edit/{jid}/session/{session}', 'StationController@alas_hak_edit');
    Route::get(config('app.root') . '/berkas/{pid}/{nob}/{doc}/view/{jid}/session/{session}', 'StationController@alas_hak_view');

    Route::get(config('app.root') . '/json/pemohon/{id}', 'PemohonController@json_pemohon_edit');
    Route::post(config('app.root') . '/json/pemohon/{pid}/{nob}/{doc}', 'PemohonController@json_pemohon_index');
    Route::resource(config('app.root') . '/pemohon', 'PemohonController', [
        'names' => [
            'index' => 'pemohon',
            'create' => 'pemohon.create',
            'store' => 'pemohon.store',
        ]
    ]);

    Route::get(config('app.root') . '/json/persil/{id}', 'PersilController@json_persil_edit');
    Route::post(config('app.root') . '/json/persil/{pid}/{nob}/{doc}', 'PersilController@json_persil_index');
    Route::resource(config('app.root') . '/persil', 'PersilController', [
        'names' => [
            'index' => 'persil',
            'create' => 'persil.create',
            'store' => 'persil.store',
        ]
    ]);
    /*** end station **/
    /** sub process **/

    /** saksi **/
    Route::get(config('app.root') . '/json/saksi/{id}', 'SaksiController@json_saksi_edit');
    Route::post(config('app.root') . '/json/saksi', 'SaksiController@json_saksi_index');
    Route::post(config('app.root') . '/saksi', 'SaksiController@store');
    Route::put(config('app.root') . '/saksi/{id}', 'SaksiController@update');
    Route::delete(config('app.root') . '/saksi/{id}', 'SaksiController@destroy');
    Route::get(config('app.root') . '/saksi/{pid}/{nob}/{doc}/{session}', 'SaksiController@index');
    Route::post(config('app.root') . '/entri-saksi', 'SaksiController@entri_saksi');

    /** temp **/
    Route::post(config('app.root') . '/json/temp-saksi/{session}', 'SaksiController@json_temp_saksi_index');
    Route::delete(config('app.root') . '/temp-saksi/{id}', 'SaksiController@temp_saksi_destroy');
    /** end temp **/
    /** end saksi **/

    /** pihak pertama **/
    Route::get(config('app.root') . '/json/pihak-pertama/{id}', 'PihakPertamaController@json_pihak_pertama_edit');
    Route::post(config('app.root') . '/json/pihak-pertama', 'PihakPertamaController@json_pihak_pertama_index');
    Route::post(config('app.root') . '/pihak-pertama', 'PihakPertamaController@store');
    Route::put(config('app.root') . '/pihak-pertama/{id}', 'PihakPertamaController@update');
    Route::delete(config('app.root') . '/pihak-pertama/{id}', 'PihakPertamaController@destroy');
    Route::get(config('app.root') . '/pihak-pertama/{pid}/{nob}/{doc}/{session}', 'PihakPertamaController@index');
    Route::post(config('app.root') . '/entri-pihak-pertama', 'PihakPertamaController@entri_pihak_pertama');

    /** temp **/
    Route::post(config('app.root') . '/json/temp-pihak-pertama/{session}', 'PihakPertamaController@json_temp_pihak_pertama_index');
    Route::delete(config('app.root') . '/temp-pihak-pertama/{id}', 'PihakPertamaController@temp_pihak_pertama_destroy');
    /** end temp **/
    /** end pihak pertama **/

    /** persetujuan keluarga **/
    Route::get(config('app.root') . '/json/persetujuan-keluarga/{id}', 'PersetujuanKeluargaController@json_persetujuan_keluarga_edit');
    Route::post(config('app.root') . '/json/persetujuan-keluarga', 'PersetujuanKeluargaController@json_persetujuan_keluarga_index');
    Route::post(config('app.root') . '/persetujuan-keluarga', 'PersetujuanKeluargaController@store');
    Route::put(config('app.root') . '/persetujuan-keluarga/{id}', 'PersetujuanKeluargaController@update');
    Route::delete(config('app.root') . '/persetujuan-keluarga/{id}', 'PersetujuanKeluargaController@destroy');
    Route::get(config('app.root') . '/persetujuan-keluarga/{pid}/{nob}/{doc}/{session}', 'PersetujuanKeluargaController@index');
    Route::post(config('app.root') . '/entri-persetujuan-keluarga', 'PersetujuanKeluargaController@entri_persetujuan_keluarga');

    /** temp **/
    Route::post(config('app.root') . '/json/temp-persetujuan-keluarga/{session}', 'PersetujuanKeluargaController@json_temp_persetujuan_keluarga_index');
    Route::delete(config('app.root') . '/temp-persetujuan-keluarga/{id}', 'PersetujuanKeluargaController@temp_persetujuan_keluarga_destroy');
    /** end temp **/
    /** end persetujuan keluarga **/

    /** ahli waris **/
    Route::get(config('app.root') . '/json/ahli-waris/{id}', 'AhliWarisController@json_ahli_waris_edit');
    Route::post(config('app.root') . '/json/ahli-waris', 'AhliWarisController@json_ahli_waris_index');
    Route::post(config('app.root') . '/ahli-waris', 'AhliWarisController@store');
    Route::put(config('app.root') . '/ahli-waris/{id}', 'AhliWarisController@update');
    Route::delete(config('app.root') . '/ahli-waris/{id}', 'AhliWarisController@destroy');
    Route::get(config('app.root') . '/ahli-waris/{pid}/{nob}/{doc}/{session}', 'AhliWarisController@index');
    Route::post(config('app.root') . '/entri-ahli-waris', 'AhliWarisController@entri_ahli_waris');

    /** temp **/
    Route::post(config('app.root') . '/json/temp-ahli-waris/{session}', 'AhliWarisController@json_temp_ahli_waris_index');
    Route::delete(config('app.root') . '/temp-ahli-waris/{id}', 'AhliWarisController@temp_ahli_waris_destroy');
    /** end temp **/
    /** end ahli waris **/

    /** penerima kuasa **/
    Route::get(config('app.root') . '/json/penerima-kuasa/{id}', 'PenerimaKuasaController@json_penerima_kuasa_edit');
    Route::post(config('app.root') . '/json/penerima-kuasa', 'PenerimaKuasaController@json_penerima_kuasa_index');
    Route::post(config('app.root') . '/penerima-kuasa', 'PenerimaKuasaController@store');
    Route::put(config('app.root') . '/penerima-kuasa/{id}', 'PenerimaKuasaController@update');
    Route::delete(config('app.root') . '/penerima-kuasa/{id}', 'PenerimaKuasaController@destroy');
    Route::get(config('app.root') . '/penerima-kuasa/{pid}/{nob}/{doc}/{session}', 'PenerimaKuasaController@index');
    Route::post(config('app.root') . '/entri-penerima-kuasa', 'PenerimaKuasaController@entri_penerima_kuasa');

    /** temp **/
    Route::post(config('app.root') . '/json/temp-penerima-kuasa/{session}', 'PenerimaKuasaController@json_temp_penerima_kuasa_index');
    Route::delete(config('app.root') . '/temp-penerima-kuasa/{id}', 'PenerimaKuasaController@temp_penerima_kuasa_destroy');
    /** end temp **/
    /** end penerima kuasa **/

    /** penyanggah **/
    Route::get(config('app.root') . '/json/penyanggah/{id}', 'PenyanggahController@json_penyanggah_edit');
    Route::post(config('app.root') . '/json/penyanggah', 'PenyanggahController@json_penyanggah_index');
    Route::post(config('app.root') . '/penyanggah', 'PenyanggahController@store');
    Route::put(config('app.root') . '/penyanggah/{id}', 'PenyanggahController@update');
    Route::delete(config('app.root') . '/penyanggah/{id}', 'PenyanggahController@destroy');
    Route::get(config('app.root') . '/penyanggah/{pid}/{nob}/{doc}/{session}', 'PenyanggahController@index');
    Route::post(config('app.root') . '/entri-penyanggah', 'PenyanggahController@entri_penyanggah');

    /** temp **/
    Route::post(config('app.root') . '/json/temp-penyanggah/{session}', 'PenyanggahController@json_temp_penyanggah_index');
    Route::delete(config('app.root') . '/temp-penyanggah/{id}', 'PenyanggahController@temp_penyanggah_destroy');
    /** end temp **/
    /** end penyanggah **/
    /** end sub process **/

    Route::resource(config('app.root') . '/alas-hak', 'AlasHakController', [
        'names' => [
            'index' => 'alas-hak',
            'create' => 'alas-hak.create',
            'store' => 'alas-hak.store',
        ]
    ]);
    Route::get(config('app.root') . '/berkas/{pid}/{nob}/{doc}/print/{id}', 'ReportController@alas_hak_print');
});
