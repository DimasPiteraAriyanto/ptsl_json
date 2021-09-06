<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempPihakPertamasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_pihak_pertama', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pihak_pertama_id')->unsigned();
            $table->foreign('pihak_pertama_id')->references('id')->on('pihak_pertama')->onDelete('cascade');
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
        Schema::dropIfExists('temp_pihak_pertamas');
    }
}
