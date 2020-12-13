<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',30);
            $table->string('email',30)->unique();
            $table->enum('jenis_kelamin',['pria','wanita']);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('no_hp',13);
            $table->string('avatar',50)->nullable();
            $table->enum('role',['pengelola_wisata','admin','wisatawan']);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',60);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
