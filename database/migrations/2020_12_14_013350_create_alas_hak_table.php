<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlasHakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alas_hak', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('penlok_id')->unsigned();
            $table->foreign('penlok_id')->references('id')->on('penlok')->onDelete('cascade');
            $table->bigInteger('jenis_alas_hak_id')->unsigned();
            $table->foreign('jenis_alas_hak_id')->references('id')->on('jenis_alas_hak')->onDelete('cascade');
            $table->bigInteger('pemohon_id')->unsigned();
            $table->foreign('pemohon_id')->references('id')->on('pemohon')->onDelete('cascade');
            $table->bigInteger('doc');
            $table->string('klaster');
            $table->string('status_surat');
            $table->string('jenis_hak');
            $table->string('nama_alas_hak');
            $table->string('no_alas_hak');
            $table->string('tanggal_alas_hak');
            $table->string('pembuat_alas_hak');
            $table->string('luas_yang_dimohon');
            $table->string('utara');
            $table->string('timur');
            $table->string('selatan');
            $table->string('barat');
            $table->string('harga');
            $table->string('nama_almarhum');
            $table->date('tanggal_meninggal');
            $table->string('desa_meninggal');
            $table->string('kecamatan_meninggal');
            $table->string('kabupaten_meninggal');
            $table->string('desa_tinggal');
            $table->string('kecamatan_tinggal');
            $table->string('kabupaten_tinggal');
            $table->string('perkawinan_dengan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alas_hak');
    }
}
