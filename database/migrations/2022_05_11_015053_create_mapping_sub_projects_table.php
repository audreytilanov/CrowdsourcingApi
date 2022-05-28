<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingSubProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapping_sub_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mapping_sub_grup_id');
            $table->foreignId('rincian_jasa_id');
            $table->foreignId('pegawai_id');
            $table->integer('persentasi_gaji');
            $table->string('sub_project');

            $table->timestamps();

            $table->foreign('mapping_sub_grup_id')->references('id')->on('mapping_sub_grups')->onDelete('cascade');
            $table->foreign('rincian_jasa_id')->references('id')->on('rincian_jasas')->onDelete('cascade');
            $table->foreign('pegawai_id')->references('id')->on('pegawais')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mapping_sub_projects');
    }
}
