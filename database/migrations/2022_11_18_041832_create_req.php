<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('req', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ruang_id');
            $table->string('penanggung_jawab');
            $table->date('tanggal');
            $table->time('dari');
            $table->time('sampai');
            $table->string('status');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('ruang_id')->references('id')->on('ruang')->onDelete('cascade');
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
        Schema::dropIfExists('req');
    }
}
