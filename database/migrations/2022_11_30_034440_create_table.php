<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('id');
            $table->string('pegawai_nip');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('role');
            $table->foreign('pegawai_nip')->references('nip_baru')->on('pegawais')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('peminjaman_ruang', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_kegiatan');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ruang_id');
            $table->dateTime('mulai');
            $table->integer('durasi');
            $table->string('status');
            $table->string('parent_id')->nullable();
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
        Schema::dropIfExists('user');
    }
}
