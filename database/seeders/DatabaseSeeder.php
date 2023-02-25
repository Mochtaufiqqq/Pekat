<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Masyarakat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        \App\Models\Petugas::create([
            'nama_petugas' => 'Administrator',
            'username' => 'admin',
            'email' => 'mochamadtaufiq2122@gmail.com',
            'alamat' => 'JL.Rancamanyar',
            'password' => Hash::make('password'),
            'telp' => '08979090',
            'level' => 'admin',

        ]);

        \App\Models\Petugas::create([
            'nama_petugas' => 'Administrator2',
            'username' => 'admin2',
            'email' => 'exmp@gmail.com',
            'alamat' => 'california',
            'password' => Hash::make('password'),
            'telp' => '08979090',
            'level' => 'admin',

        ]);

        \App\Models\Petugas::create([
            'nama_petugas' => 'Petugas',
            'username' => 'petugas',
            'email' => 'exmp2@gmail.com',
            'alamat' => 'california',
            'password' => Hash::make('password'),
            'telp' => '089790908',
            'level' => 'petugas',

        ]);

        \App\Models\Petugas::create([
            'nama_petugas' => 'Petugas2',
            'username' => 'petugas2',
            'email' => 'exmp2@gmail.com',
            'alamat' => 'california',
            'password' => Hash::make('password'),
            'telp' => '089790908',
            'level' => 'petugas',

        ]);

        Masyarakat::create([
            'nik' => '32091031',
            'username' => 'user2',
            'nama' => 'piqqq',
            'alamat' => 'Jl.Cibaduyut',
            'email' => 'exmp2@gmail.com',
            'password' => Hash::make('123123123'),
            'telp' => '0897909012',

        ]);
        
        Masyarakat::create([
            'nik' => '32091030',
            'username' => 'user',
            'nama' => 'claire',
            'alamat' => 'Jl.Baleendah',
            'email' => 'mhmdtaufiq3@gmail.com',
            'password' => Hash::make('123123123'),
            'telp' => '0897909042',

        ]);

        Masyarakat::create([
            'nik' => '32091032',
            'username' => 'user3',
            'nama' => 'Mochamad Taufiq',
            'alamat' => 'Jl.cangkuang',
            'email' => 'exmpuser@gmail.com',
            'password' => Hash::make('123123123'),
            'telp' => '0897909042',

        ]);
    }
}
