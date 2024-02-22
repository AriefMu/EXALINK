<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamaruang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjamanruang', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ruang_id');
            $table->dateTime('mulai');
            $table->dateTime('selesai');
            $table->enum('status',['proses','tolak','setuju'])->default('proses');
            $table->string('parent_id')->nullable();
            $table->string('approveby')->nullable();
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
        Schema::dropIfExists('peminjamanruang');
    }
}
