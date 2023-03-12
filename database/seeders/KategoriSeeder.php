<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::create([
            'kategori' => 'Hiburan'
        ]);

        Kategori::create([
            'kategori' => 'Infrastruktur'
        ]);

        Kategori::create([
            'kategori' => 'Lingkungan'
        ]);

        Kategori::create([
            'kategori' => 'Bencana Alam'
        ]);

        Kategori::create([
            'kategori' => 'Fasilitas Umum'
        ]);

        Kategori::create([
            'kategori' => 'Layanan Publik'
        ]);

        Kategori::create([
            'kategori' => 'Permohonan Informasi'
        ]);

        Kategori::create([
            'kategori' => 'Aspirasi'
        ]);

        Kategori::create([
            'kategori' => 'Lainnya'
        ]);
    }
}
