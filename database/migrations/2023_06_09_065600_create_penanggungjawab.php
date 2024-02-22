<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenanggungjawab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penanggungjawab', function (Blueprint $table) {
            $table->id();
            $table->string('pegawai_nip');
            $table->timestamps();
            $table->foreign('pegawai_nip')->references('nip_baru')->on('pegawais')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penanggungjawab');
    }
}
