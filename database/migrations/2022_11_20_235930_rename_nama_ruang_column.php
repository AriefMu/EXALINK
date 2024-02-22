<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\RenameColumn;
use Illuminate\Support\Facades\Schema;

class RenameNamaRuangColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ruang', function (Blueprint $table) {
            $table -> RenameColumn('ruang','nama');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ruang', function (Blueprint $table) {
            Schema::table('ruang', function (Blueprint $table) {
                $table -> RenameColumn('nama','ruang');
            });
        });
    }
}
