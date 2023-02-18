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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id('id_pengaduan');
            $table->dateTime('tgl_pengaduan');
            $table->char('nik',16);
            $table->string('judul_laporan');
            $table->longText('isi_laporan');
            $table->longText('foto')->nullable();
            $table->longText('lokasi_kejadian')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->enum('status', ['0','proses','selesai']);
            $table->string('hide_identitas')->default('1');
            $table->string('hide_laporan')->default('1');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('nik')->references('nik')->on('masyarakats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaduans');
    }
};
