<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempPersetujuanKeluargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_persetujuan_keluarga', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('persetujuan_keluarga_id')->unsigned();
            $table->foreign('persetujuan_keluarga_id')->references('id')->on('persetujuan_keluarga')->onDelete('cascade');
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
        Schema::dropIfExists('temp_persetujuan_keluargas');
    }
}
