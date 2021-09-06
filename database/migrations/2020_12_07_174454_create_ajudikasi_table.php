<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAjudikasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ajudikasi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('proyek_id')->unsigned();
            $table->foreign('proyek_id')->references('id')->on('proyek')->onDelete('cascade');
            $table->string('nip');
            $table->string('nama_pegawai');
            $table->string('golongan');
            $table->string('jabatan_ajudikasi');
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
        Schema::dropIfExists('ajudikasi');
    }
}
