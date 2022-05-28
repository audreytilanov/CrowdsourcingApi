<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRincianJasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rincian_jasas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jasa_id');
            $table->string('nama');
            $table->timestamps();

            $table->foreign('jasa_id')->references('id')->on('jasas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rincian_jasas');
    }
}
