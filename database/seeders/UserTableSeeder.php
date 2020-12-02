<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
        'email' => 'a@a.com',
        'password' => bcrypt('a'),
        'jenis_kelamin' => 'pria',
        'tanggal_lahir' => '2000-03-11',
        'role' => 'admin',
        'alamat' => 'nguling',
        'no_hp' => '0856354635463',
        'avatar' => 'f240f8dd16f74eb50809218aaffa20a1.png',
        ]);
        User::create([
            'name' => 'wisatawan',
        'email' => 'w@w.com',
        'password' => bcrypt('w'),
        'jenis_kelamin' => 'pria',
        'tanggal_lahir' => '2000-03-11',
        'role' => 'wisatawan',
        'alamat' => 'nguling',
        'no_hp' => '0856354635463',
        'avatar' => 'f240f8dd16f74eb50809218aaffa20a1.png',
        ]);
        $p = User::create([
            'name' => 'pengelola wisata',
        'email' => 'p@p.com',
        'password' => bcrypt('p'),
        'jenis_kelamin' => 'pria',
        'tanggal_lahir' => '2000-03-11',
        'role' => 'pengelola_wisata',
        'alamat' => 'nguling',
        'no_hp' => '0856354635463',
        'avatar' => 'f240f8dd16f74eb50809218aaffa20a1.png',
        ]);
        $p->wisata()->create([
            'scan_ktp'=> '38d660018eed6cfec332cb1f633dc141.png', 
            'nik' => '049598989',
        ]);
    }
}
