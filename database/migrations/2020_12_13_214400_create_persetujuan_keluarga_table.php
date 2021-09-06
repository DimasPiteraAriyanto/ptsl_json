<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersetujuanKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persetujuan_keluarga', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('no_telp');
            $table->string('nama_persetujuan_keluarga');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('pekerjaan');
            $table->string('agama');
            $table->enum('jenis_kelamin', ['0','1']);
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kabupaten');
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
        Schema::dropIfExists('persetujuan_keluarga');
    }
}
