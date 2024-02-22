<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailpeminjamanruang', function (Blueprint $table) {
            $table->id('id');
            $table->string('namakeg');
            $table->dateTime('mulai');
            $table->dateTime('selesai');
            $table->string('approvedby')->nullable();
            $table->text('alasan')->nullable();
            $table->timestamps();
        });
        Schema::create('peminjamanruang', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('dtpr_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ruang_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('penanggungjawab_id');
            $table->foreign('dtpr_id')->references('id')->on('detailpeminjamanruang')->onDelete('cascade');
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
        Schema::dropIfExists('two');
    }
}
