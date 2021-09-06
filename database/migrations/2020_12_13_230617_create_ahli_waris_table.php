<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAhliWarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ahli_waris', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('no_telp');
            $table->string('nama_ahli_waris');
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
        Schema::dropIfExists('ahli_waris');
    }
}
