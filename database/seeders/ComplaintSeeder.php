<?php

namespace Database\Seeders;

use App\Models\Pengaduan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengaduan::create([
            'nik' => '32091030',
            'judul_laporan' => 'Jalan Rusak',
            'tgl_pengaduan' => '21-08-2023',
            'isi_laporan' => 'Beberapa jalan terlihat berlubang,sangat membahayakan sekali bagi pengendara terutama pada saat malam hari karena lampu penerangan tidak terlalu terang.',
            // 'lokasi_kejadian' => 'Jl.Andir-Katapang',
            'status' => 'proses',
            'hide_identitas' => '1',
            'hide_laporan' => '1'
            
        ]);

        Pengaduan::create([
            'nik' => '32091030',
            'judul_laporan' => 'Banjir',
            'tgl_pengaduan' => '21-08-2023',
            'isi_laporan' => 'Beberapa pemukiman tergenang air banjir dari sungai citarum ketinggian air sekitar 1 meter,sampai saat ini belum turun bantuan maupun tindakan dari instasi pemerintah mohon ditindak lanjuti.',
            // 'lokasi_kejadian' => 'Dayeuhkolot',
            'status' => 'selesai',
            'hide_identitas' => '2',
            'hide_laporan' => '1'
            
        ]);

        Pengaduan::create([
            'nik' => '32091031',
            'judul_laporan' => 'Listrik',
            'tgl_pengaduan' => '12-07-2023',
            'isi_laporan' => 'Listrik di desa kami mengalami padam sudah 2 hari listrik padam.',
            // 'lokasi_kejadian' => 'Rancamanyar',
            'status' => '0',
            'hide_identitas' => '1',
            'hide_laporan' => '2'
            
        ]);

        Pengaduan::create([
            'nik' => '32091031',
            'judul_laporan' => 'Bangunan liar',
            'tgl_pengaduan' => '21-09-2023',
            'isi_laporan' => 'Terlihat bangunan liar pinggir jalan yang sudah berdiri 1 bulan yang lalu bangunan itu sangat menggangu karena bangunan tidak rapih serta membahayakan pengendara karena lokasinya sangat berdempetan dengan jalan raya .',
            // 'lokasi_kejadian' => 'Cibaduyut',
            'status' => '0',
            'hide_identitas' => '1',
            'hide_laporan' => '1'
            
        ]);
    }
}
