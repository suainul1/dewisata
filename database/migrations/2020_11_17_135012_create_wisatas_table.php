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
            $table->string('nama_wisata',30)->nullable(); 
            $table->string('alamat_wisata',50)->nullable(); 
            $table->string('jam_operasional',15)->nullable();
            $table->enum('jenis_wisata',['budaya/sejarah','bahari','cagar alam','konvensi','agrowisata','berburuh','ziarah'])->nullable();
            $table->text('deskripsi_wisata')->nullable();
            $table->string('slug',100)->nullable();
            $table->string('dokumen_wisata',50)->nullable();
            $table->string('scan_ktp',50);
            $table->string('nik',20);
            $table->integer('kapasitas')->nullable();
            $table->text('pesan')->nullable();
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
