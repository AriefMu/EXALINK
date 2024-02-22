<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('ruang', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama');
            $table->unsignedBigInteger('lantai_id');
            $table->foreign('lantai_id')->references('id')->on('lantai')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('peminjamanruang', function (Blueprint $table) {
            $table->id('id');
            $table->string('namakeg');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ruang_id');
            $table->dateTime('mulai');
            $table->integer('durasi');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('penanggungjawab_id');
            $table->unsignedBigInteger('approvedby');
            $table->text('alasan');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('ruang_id')->references('id')->on('ruang')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
            $table->foreign('penanggungjawab_id')->references('id')->on('penanggungjawab')->onDelete('cascade');
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
        Schema::dropIfExists('table_two');
    }
}
