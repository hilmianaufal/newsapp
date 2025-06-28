<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesans', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('pengirim_id'); // id admin
                $table->unsignedBigInteger('penerima_id'); // id penulis
                $table->text('isi');
                $table->timestamps();

                // Relasi opsional
                $table->foreign('pengirim_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('penerima_id')->references('id')->on('users')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesans');
    }
};
