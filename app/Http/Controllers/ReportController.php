<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penlok;
use App\Models\AlasHak;
use App\Models\PihakPertama;
use App\Models\TempPihakPertama;
use App\Models\Saksi;
use App\Models\TempSaksi;
use App\Models\PersetujuanKeluarga;
use App\Models\TempPersetujuanKeluarga;
use App\Models\AhliWaris;
use App\Models\TempAhliWaris;
use Terbilang;
use WordTemplate;

class ReportController extends Controller
{
    public function alas_hak_print(Request $request)
    {
        $alas_hak = AlasHak::find($request->id);
        if ($alas_hak->jenis_alas_hak_id == 5) {
            $temp_pihak_pertama = TempPihakPertama::where('session', @$alas_hak->session)->first();
            $pihak_pertama = $temp_pihak_pertama->pihak_pertama;

            $pemohon = @$alas_hak->pemohon;

            $temp_saksi = TempSaksi::where('session', @$alas_hak->session)->get();
            foreach ($temp_saksi as $key => $val) {
                $saksi[] = Saksi::find($val->saksi_id);
            }

            $temp_persetujuan_keluarga = TempPersetujuanKeluarga::where('session', @$alas_hak->session)->get();
            foreach ($temp_persetujuan_keluarga as $key => $val) {
                $pk[] = PersetujuanKeluarga::find($val->persetujuan_keluarga_id);
            }

            $file = public_path('report/hibah.rtf');
            $array = array(
                '[NOMOR_SURAT]' => @$alas_hak->id . '/' . date('d') . '/' . date('m') . '/' . date('Y'),
                '[NAMA_PENGGARAP]' => @$pihak_pertama->nama_pihak_pertama,
                '[TANGGAL_LAHIR_PENGGARAP]' => @$pihak_pertama->tanggal_lahir->format('d F Y'),
                '[ALAMAT_PENGGARAP]' => @$pihak_pertama->desa . ", " . $pihak_pertama->kecamatan . " - " . $pihak_pertama->kabupaten,
                '[PEKERJAAN_PENGGARAP]' => '-',
                '[NAMA_PIHAK_II]' => @$pemohon->nama_pemohon,
                '[TEMPAT_TANGGAL_LAHIR]' => @$pemohon->tempat_lahir . ", " . $pemohon->tanggal_lahir->format('d F Y'),
                '[PEKERJAAN_PIHAK_II]' => '-',
                '[ALAMAT_PIHAK_II]' => @$pemohon->desa . ", " . $pemohon->kecamatan . " - " . $pemohon->kabupaten,
                '[LUAS_TANAH]' => @$alas_hak->luas_yang_dimohon,
                '[UTARA]' => @$alas_hak->utara,
                '[TIMUR]' => @$alas_hak->timur,
                '[SELATAN]' => @$alas_hak->selatan,
                '[BARAT]' => @$alas_hak->barat,
                '[KK1]' => @$pk[0]->nama_persetujuan_keluarga,
                '[KK2]' => @$pk[1]->nama_persetujuan_keluarga,
                '[KK3]' => @$pk[2]->nama_persetujuan_keluarga,
                '[KK4]' => @$pk[3]->nama_persetujuan_keluarga,
                '[KK5]' => @$pk[4]->nama_persetujuan_keluarga,
                '[KK6]' => @$pk[5]->nama_persetujuan_keluarga,
                '[SAKSI1]' => @$saksi[0]->nama_saksi,
                '[SAKSI2]' => @$saksi[1]->nama_saksi,
                '[DESA_PENLOK]' => @$alas_hak->penlok->desa->nama_desa,
                '[KECAMATAN_PENLOK]' => @$alas_hak->penlok->desa->kecamatan->nama_kecamatan,
                '[KABUPATEN_PENLOK]' => @$alas_hak->penlok->desa->kecamatan->kabupaten->nama_kabupaten,
                '[REJE_KAMPUNG]' => @$alas_hak->penlok->desa->reje_kampung,
                '[TANGGAL_CETAK]' => date('d F Y'),
            );

            // dd($array);

            $nama_file = rand(111111, 999999) . '.doc';

            return WordTemplate::export($file, $array, $nama_file);
        } elseif ($alas_hak->jenis_alas_hak_id == 4) {
            $temp_pihak_pertama = TempPihakPertama::where('session', @$alas_hak->session)->first();
            $pihak_pertama = $temp_pihak_pertama->pihak_pertama;

            $pemohon = @$alas_hak->pemohon;

            $temp_saksi = TempSaksi::where('session', @$alas_hak->session)->get();
            foreach ($temp_saksi as $key => $val) {
                $saksi[] = Saksi::find($val->saksi_id);
            }

            $file = public_path('report/jual-beli.rtf');
            $array = array(
                '[NOMOR_SURAT]' => @$alas_hak->id . '/' . date('d') . '/' . date('m') . '/' . date('Y'),
                '[NAMA_PIHAK_I]' => @$pihak_pertama->nama_pihak_pertama,
                '[NIK_PIHAK_I]' => @$pihak_pertama->nik,
                '[TANGGAL_LAHIR_PIHAK_I]' => @$pihak_pertama->tanggal_lahir->format('d F Y'),
                '[WARGA_NEGARA_PIHAK_I]' => "Indonesia",
                '[PEKERJAAN_PIHAK_I]' => @$pihak_pertama->pekerjaan,
                '[ALAMAT_PIHAK_I]' => @$pihak_pertama->desa . ", " . $pihak_pertama->kecamatan . " - " . $pihak_pertama->kabupaten,
                '[NAMA_PIHAK_II]' => @$pemohon->nama_pemohon,
                '[NIK_PIHAK_II]' => @$pemohon->nik,
                '[TEMPAT_TANGGAL_LAHIR_PIHAK_II]' => @$pemohon->tempat_lahir . ", " . $pemohon->tanggal_lahir->format('d F Y'),
                '[WARGA_NEGARA_PIHAK_II]' => "Indonesia",
                '[PEKERJAAN_PIHAK_II]' => @$pemohon->pekerjaan,
                '[ALAMAT_PIHAK_II]' => @$pemohon->desa . ", " . $pemohon->kecamatan . " - " . $pemohon->kabupaten,
                '[HARGA]' => @$alas_hak->harga,
                '[TERBILANG]' => Terbilang::make($alas_hak->harga),
                '[JALAN]' => @$alas_hak->jalan,
                '[KABUPATEN]' => @$alas_hak->kabupaten,
                '[KECAMATAN]' => @$alas_hak->kecamatan,
                '[DESA]' => @$alas_hak->desa,
                '[LUAS]' => @$alas_hak->luas_yang_dimohon,
                '[UTARA]' => @$alas_hak->utara,
                '[TIMUR]' => @$alas_hak->timur,
                '[SELATAN]' => @$alas_hak->selatan,
                '[BARAT]' => @$alas_hak->barat,
                '[NAMA_SAKSI_I]' => @$saksi[0]->nama_saksi,
                '[NIK_SAKSI_I]' => @$saksi[0]->nik,
                '[PEKERJAAN_SAKSI_I]' => @$saksi[0]->pekerjaan,
                '[DESA_SAKSI_I]' => @$saksi[0]->desa,
                '[KEC_SAKSI_I]' => @$saksi[0]->kecamatan,
                '[KAB_SAKSI_I]' => @$saksi[0]->kabupaten,
                '[NAMA_SAKSI_II]' => @$saksi[1]->nama_saksi,
                '[NIK_SAKSI_II]' => @$saksi[1]->nik,
                '[PEKERJAAN_SAKSI_II]' => @$saksi[1]->pekerjaan,
                '[DESA_SAKSI_II]' => @$saksi[1]->desa,
                '[KEC_SAKSI_II]' => @$saksi[1]->kecamatan,
                '[KAB_SAKSI_II]' => @$saksi[1]->kabupaten,
                '[DESA_PENLOK]' => @$alas_hak->penlok->desa->nama_desa,
                '[DESA_PENLOK_BIG]' => @strtoupper($alas_hak->penlok->desa->nama_desa),
                '[NAMA_CAMAT]' => @strtoupper($alas_hak->penlok->desa->nama_camat),
                '[NIP_CAMAT]' => @strtoupper($alas_hak->penlok->desa->nip),
                '[KABUPATEN_DESA_PENLOK_BIG]' => @strtoupper($alas_hak->penlok->desa->kecamatan->kabupaten->nama_kabupaten),
                '[KECAMATAN_DESA_PENLOK]' => @$alas_hak->penlok->desa->kecamatan->nama_kecamatan,
                '[KECAMATAN_DESA_PENLOK_BIG]' => @strtoupper($alas_hak->penlok->desa->kecamatan->nama_kecamatan),
                '[REJE_KAMPUNG]' => @$alas_hak->penlok->desa->reje_kampung,
                '[ALAMAT_DESA_PENLOK]' => @$alas_hak->penlok->desa->alamat,
                '[KODE_POS_DESA_PENLOK]' => @$alas_hak->penlok->desa->kode_pos,
                '[TANGGAL_CETAK]' => date('d F Y'),
            );

            // dd($array);

            $nama_file = rand(111111, 999999) . '.doc';
            return WordTemplate::export($file, $array, $nama_file);
        } elseif ($alas_hak->jenis_alas_hak_id == 6) {
            $temp_saksi = TempSaksi::where('session', @$alas_hak->session)->get();
            foreach ($temp_saksi as $key => $val) {
                $saksi[] = Saksi::find($val->saksi_id);
            }

            $temp_ahli_waris = TempAhliWaris::where('session', @$alas_hak->session)->get();
            foreach ($temp_ahli_waris as $key => $val) {
                $aw[] = AhliWaris::find($val->ahli_waris_id);
            }

            $pemohon = @$alas_hak->pemohon;

            $file = public_path('report/warisan.rtf');
            $array = array(
                '[NAMA_ALMARHUM]' => @$alas_hak->nama_almarhum,
                '[TANGGAL_MENINGGAL]' => @$alas_hak->tanggal_meninggal->format('d F Y'),
                '[DESA_TINGGAL]' => @$alas_hak->desa_tinggal,
                '[KECAMATAN_TINGGAL]' => @$alas_hak->kecamatan_tinggal,
                '[PERKAWINAN_DENGAN]' => @$alas_hak->perkawinan_dengan,
                '[ANAK1]' => @$aw[0]->nama_ahli_waris,
                '[ANAK2]' => @$aw[1]->nama_ahli_waris,
                '[ANAK3]' => @$aw[2]->nama_ahli_waris,
                '[ANAK4]' => @$aw[3]->nama_ahli_waris,
                '[ANAK5]' => @$aw[4]->nama_ahli_waris,
                '[ANAK6]' => @$aw[5]->nama_ahli_waris,
                '[ANAK7]' => @$aw[6]->nama_ahli_waris,
                '[ANAK8]' => @$aw[7]->nama_ahli_waris,
                '[ANAK9]' => @$aw[8]->nama_ahli_waris,
                '[ANAK10]' => @$aw[9]->nama_ahli_waris,
                '[PEKERJAAN1]' => @$aw[0]->pekerjaan,
                '[PEKERJAAN2]' => @$aw[1]->pekerjaan,
                '[PEKERJAAN3]' => @$aw[2]->pekerjaan,
                '[PEKERJAAN4]' => @$aw[3]->pekerjaan,
                '[PEKERJAAN5]' => @$aw[4]->pekerjaan,
                '[PEKERJAAN6]' => @$aw[5]->pekerjaan,
                '[PEKERJAAN7]' => @$aw[6]->pekerjaan,
                '[PEKERJAAN8]' => @$aw[7]->pekerjaan,
                '[PEKERJAAN9]' => @$aw[8]->pekerjaan,
                '[PEKERJAAN10]' => @$aw[9]->pekerjaan,
                '[ALAMAT1]' => @$aw[0]->desa . ' ' . @$aw[0]->kecamatan . ' ' . @$aw[0]->kabupaten,
                '[ALAMAT2]' => @$aw[1]->desa . ' ' . @$aw[1]->kecamatan . ' ' . @$aw[1]->kabupaten,
                '[ALAMAT3]' => @$aw[2]->desa . ' ' . @$aw[2]->kecamatan . ' ' . @$aw[2]->kabupaten,
                '[ALAMAT4]' => @$aw[3]->desa . ' ' . @$aw[3]->kecamatan . ' ' . @$aw[3]->kabupaten,
                '[ALAMAT5]' => @$aw[4]->desa . ' ' . @$aw[4]->kecamatan . ' ' . @$aw[4]->kabupaten,
                '[ALAMAT6]' => @$aw[5]->desa . ' ' . @$aw[5]->kecamatan . ' ' . @$aw[5]->kabupaten,
                '[ALAMAT7]' => @$aw[6]->desa . ' ' . @$aw[6]->kecamatan . ' ' . @$aw[6]->kabupaten,
                '[ALAMAT8]' => @$aw[7]->desa . ' ' . @$aw[7]->kecamatan . ' ' . @$aw[7]->kabupaten,
                '[ALAMAT9]' => @$aw[8]->desa . ' ' . @$aw[8]->kecamatan . ' ' . @$aw[8]->kabupaten,
                '[ALAMAT10]' => @$aw[9]->desa . ' ' . @$aw[9]->kecamatan . ' ' . @$aw[9]->kabupaten,
                '[SAKSI1]' => @$saksi[0]->nama_saksi,
                '[SAKSI2]' => @$saksi[1]->nama_saksi,
                '[DESA_PENLOK]' => $alas_hak->penlok->desa->nama_desa,
                '[KECAMATAN_PENLOK]' => $alas_hak->penlok->desa->kecamatan->nama_kecamatan,
                '[KABUPATEN_PENLOK]' => $alas_hak->penlok->desa->kecamatan->kabupaten->nama_kabupaten,
                '[REJE_KAMPUNG]' => $alas_hak->penlok->desa->reje_kampung,
                '[NAMA_CAMAT]' => $alas_hak->penlok->desa->nama_camat,
                '[NIP_CAMAT]' => $alas_hak->penlok->desa->nip,
                '[TANGGAL_CETAK]' => date('d F Y'),
                '[LUAS_YANG_DIMOHON]' => $alas_hak->luas_yang_dimohon,
                '[NAMA_PEMOHON]' => $pemohon->nama_pemohon,
                '[UTARA]' => $alas_hak->utara,
                '[TIMUR]' => $alas_hak->timur,
                '[SELATAN]' => $alas_hak->selatan,
                '[BARAT]' => $alas_hak->barat,
            );

            // dd($array);
            $nama_file = rand(111111, 999999) . '.doc';

            return WordTemplate::export($file, $array, $nama_file);
        }
    }
}
