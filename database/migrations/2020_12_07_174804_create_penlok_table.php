<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenlokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penlok', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('proyek_id')->unsigned();
            $table->foreign('proyek_id')->references('id')->on('proyek')->onDelete('cascade');
            $table->bigInteger('desa_id')->unsigned();
            $table->foreign('desa_id')->references('id')->on('desa')->onDelete('cascade');
            $table->bigInteger('jumlah_persil');
            $table->string('no_sk_penlok');
            $table->date('tanggal_sk_penlok');
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
        Schema::dropIfExists('penlok');
    }
}
