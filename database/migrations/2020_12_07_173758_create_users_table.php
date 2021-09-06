<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('proyek_id')->unsigned();
            $table->foreign('proyek_id')->references('id')->on('proyek')->onDelete('cascade');
            $table->bigInteger('desa_id')->unsigned();
            $table->foreign('desa_id')->references('id')->on('desa')->onDelete('cascade');
            $table->string('username');
            $table->string('password');
            $table->string('nama_lengkap');
            $table->string('level');
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
        Schema::dropIfExists('users');
    }
}
