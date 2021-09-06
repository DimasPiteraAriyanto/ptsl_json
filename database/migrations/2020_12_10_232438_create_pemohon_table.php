<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemohonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemohon', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('penlok_id')->unsigned();
            $table->foreign('penlok_id')->references('id')->on('penlok')->onDelete('cascade');
            $table->bigInteger('nob');
            $table->bigInteger('doc');
            $table->string('nik');
            $table->string('no_telp');
            $table->string('nama_pemohon');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('pekerjaan');
            $table->string('agama');
            $table->enum('jenis_kelamin', ['L','P']);
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->bigInteger('jenis_pemohon');
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
        Schema::dropIfExists('pemohon');
    }
}
