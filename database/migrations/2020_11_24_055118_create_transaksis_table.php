<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('wisata_id')->references('id')->on('wisatas')->onDelete('cascade');
            $table->string('nama_wisata');
            $table->integer('jumlah_orang');
            $table->integer('harga');
            $table->string('invoice')->nullable();
            $table->date('batas_pembayaran');
            $table->enum('status',['proses','terbayar','berkunjung','batal'])->default('proses');
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
        Schema::dropIfExists('transaksis');
    }
}
