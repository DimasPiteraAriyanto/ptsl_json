<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempSaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_saksi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('saksi_id')->unsigned();
            $table->foreign('saksi_id')->references('id')->on('saksi')->onDelete('cascade');
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
        Schema::dropIfExists('temp_saksis');
    }
}
