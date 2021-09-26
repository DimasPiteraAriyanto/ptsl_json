<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persil', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('penlok_id')->unsigned();
            $table->foreign('penlok_id')->references('id')->on('penlok')->onDelete('cascade');
            $table->bigInteger('alas_hak_id')->unsigned();
            $table->foreign('alas_hak_id')->references('id')->on('alas_hak')->onDelete('cascade');
            $table->bigInteger('pemohon_id')->unsigned();
            $table->foreign('pemohon_id')->references('id')->on('pemohon')->onDelete('cascade');
            $table->bigInteger('ajudikasi_id')->unsigned();
            $table->foreign('ajudikasi_id')->references('id')->on('ajudikasi')->onDelete('cascade');
            $table->bigInteger('doc');
            $table->string('nub');
            $table->string('tanda_batas');
            $table->string('luas_pengukuran');
            $table->string('penggunaan_tanah');
            $table->string('no_pbt');
            $table->string('no_gu');
            $table->string('no_berkas_fisik');
            $table->string('nib');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
