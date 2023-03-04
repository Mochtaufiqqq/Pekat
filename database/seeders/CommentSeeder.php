<?php

namespace Database\Seeders;

use App\Models\Tanggapan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tanggapan::create([
            'id_pengaduan' => '1',
            'tanggapan' => 'Baik pengaduan anda telah kami verifikasi akan segera kami proses',
            'id_petugas' => '1'
        ]);

        Tanggapan::create([
            'id_pengaduan' => '2',
            'tanggapan' => 'Pengaduan anda sudah kami tangani',
            'id_petugas' => '1'
        ]);
    }
}
