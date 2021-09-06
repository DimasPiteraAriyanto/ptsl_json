<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempPenerimaKuasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_penerima_kuasa', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('penerima_kuasa_id')->unsigned();
            $table->foreign('penerima_kuasa_id')->references('id')->on('penerima_kuasa')->onDelete('cascade');
            $table->string('session');
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
        Schema::dropIfExists('temp_penerima_kuasas');
    }
}
