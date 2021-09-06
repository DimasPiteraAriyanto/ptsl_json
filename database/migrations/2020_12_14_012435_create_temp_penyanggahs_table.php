<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempPenyanggahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_penyanggah', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('penyanggah_id')->unsigned();
            $table->foreign('penyanggah_id')->references('id')->on('penyanggah')->onDelete('cascade');
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
        Schema::dropIfExists('temp_penyanggahs');
    }
}
