<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailDiskusisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_diskusis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diskusi_id');
            $table->foreignId('pegawai_id');
            $table->foreignId('user_id');

            $table->text('text');

            $table->timestamps();
            $table->foreign('diskusi_id')->references('id')->on('diskusis')->onDelete('cascade');
            $table->foreign('pegawai_id')->references('id')->on('pegawais')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_diskusis');
    }
}
