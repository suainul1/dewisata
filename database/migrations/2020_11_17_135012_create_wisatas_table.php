<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWisatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wisatas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nama_wisata')->nullable(); 
            $table->string('alamat_wisata')->nullable(); 
            $table->string('jam_operasional')->nullable();
            $table->enum('jenis_wisata',['budaya/sejarah','bahari','cagar alam','konvensi','agrowisata','berburuh','ziarah'])->nullable();
            $table->text('deskripsi_wisata')->nullable();
            $table->string('slug')->nullable();
            $table->string('dokumen_wisata')->nullable();
            $table->string('scan_ktp');
            $table->string('nik');
            $table->enum('status',['terima','proses','pengajuan','tolak'])->default('proses');
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
        Schema::dropIfExists('wisatas');
    }
}
