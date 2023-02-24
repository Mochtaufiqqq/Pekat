@extends('layouts.user.master')

@section('title','Bantuan (FAQ)')

@section('content')

<section class="header-2">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <h4 class="semi-bold mb-0 text-white">LAPEKAT</h4>
                    {{-- <p class="italic mt-0 text-white">Pengaduan Masyarakat</p> --}}

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    @if(Auth::guard('masyarakat')->check())

                    <ul class="navbar-nav text-center ml-auto">
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="/contact-us">Hubungi Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="/help">Bantuan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="/home">Home</a>
                        </li>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link ml-4 dropdown-toggle text-white" href="/profile" id="navbarDropdown"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::guard('masyarakat')->user()->nama }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/profile">Profil Saya</a>
                                <a class="dropdown-item" href="/pengaduan/me">Laporan Saya</a>
                                {{-- <a class="dropdown-item" href="#">Ubah Password</a> --}}
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout">Keluar</a>
                            </div>
                        </li>
                    </ul>
                    @else
                    <ul class="navbar-nav text-center ml-auto">
                        {{-- <li class="nav-item">
                            <button class="btn text-white" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#loginModal">Tentang kami</button>
                        </li> --}}

                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="/contact-us">Hubungi Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="/help">Bantuan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="/">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link ml-2 dropdown-toggle text-white" href="/profile" id="navbarDropdown"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Masuk
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/login">Masuk sebagai masyarakat</a>
                                <a class="dropdown-item" href="/admin/login">Masuk sebagai admin</a>
                                {{-- <a class="dropdown-item" href="#">Ubah Password</a> --}}

                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pekat.formRegister') }}" class="btn btn-outline-purple">Daftar</a>
                        </li>
                    </ul>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="text-center mb">
        <h2 class="medium text-white help">Bantuan</h2>
        {{-- <hr class="tb"> --}}
    </div>

</section>


<div class="container">
    <div class="mt-4 mb-2">
        <h5 class="box-header-title">Kategori Bantuan</h5>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="sidenav">
                <p class="p-help">
                    <a class="a-nav a-active" id="nav1" onclick="showAccordion('accordion1')">Umum</a>
                </p>
                <p class="p-help">
                    <a class="a-nav " id="nav2" onclick="showAccordion('accordion2')">Pengaduan</a>
                </p>
            </div>
        </div>
        <div class="col-md-9">
            <div class="acc" id="accordioncontent1">
                <div class="accordion" style="display: block;" id="accordion1">
                    <h2 class="accordion-header">Dimana saya bisa mengakses aplikasi LAPEKAT ?</h2>
                    <div class="accordion-content">
                        <p class="italic text-secondary">Anda bisa mengakses aplikasi LAPEKAT hanya melalui browser anda
                        </p>
                    </div>
                    <h2 class="accordion-header">Bagaimana cara register akun pengguna LAPEKAT?</h2>
                    <div class="accordion-content">
                        <p class="italic text-secondary">Anda bisa melakukan register dengan klik tombol Daftar. Dan input data anda meliputi :
                            <ol>
                                <li class="italic text-secondary">NIK sesuai KTP</li>
                                <li class="italic text-secondary">Nama Lengkap Sesuai KTP</li>
                                <li class="italic text-secondary">Username berupa huruf angka atau karakter</li>
                                <li class="italic text-secondary">Email (Email harus aktif)</li>
                                <li class="italic text-secondary">Password</li>
                            </ol>
                        </p>
                    </div>
                    <h2 class="accordion-header">Siapa saja yang bisa mendaftar ?</h2>
                    <div class="accordion-content">
                        <p class="italic text-secondary">Seluruh mayarakat yang sudah memiliki kartu tanda pengenal (KTP) yang masih berlaku.</p>
                    </div>
                    <h2 class="accordion-header">Apakah laporan saya akan ditindaklanjuti sebelum akun terverifikasi?</h2>
                    <div class="accordion-content">
                        <p class="italic text-secondary">Tidak ditindaklanjut sampai akun anda diverifikasi. Jika gagal verifikasi, berarti ada kemungkinan data yang diinput tidak sama dengan yang di KTP (Seperti: NIK, nama dll).
                        </p>
                    </div>
                    <h2 class="accordion-header">Pengaduan apa saja yang bisa dilaporkan dalam aplikasi LAPEKAT?</h2>
                    <div class="accordion-content">
                        <p class="italic text-secondary">Pengaduan yang bisa dilaporkan sesuai kategori pengaduan yang telah disediakan seperti :
                            <ul>
                                <li class="italic text-secondary">Pengaduan</li>
                                <li class="italic text-secondary">Aspirasi</li>
                                <li class="italic text-secondary">Pelanggaran</li>
                                <li class="italic text-secondary">Permohonan informasi</li>
                            </ul> 
                        </p>
                    </div>
                    <h2 class="accordion-header">Apa saja yang harus diinput pada saat melapor?</h2>
                    <div class="accordion-content">
                        <p class="italic text-secondary">
                            <ol>
                                <li class="italic text-secondary">Tentukan Judul Laporan</li>
                                <li class="italic text-secondary">Deskripsi Laporan</li>
                                <li class="italic text-secondary">Tanggal Kejadian / Laporan</li>
                                <li class="italic text-secondary">Foto bukti pendukung Laporan</li>
                                <li class="italic text-secondary">Ketikan Lokasi atau bisa pilih titik lokasi melalui Map sistem</li>
                            </ol> 
                        </p>
                    </div>
                    <h2 class="accordion-header">Apa saya bisa memantau pengaduan yang telah saya buat?</h2>
                    <div class="accordion-content">
                        <p class="italic text-secondary">
                            Pengaduan yang dibuat oleh pelapor bisa dipantau dan dimonitoring langsung, berikut beberapa fitur monitoring yang bisa digunakan oleh pelapor
                            <ol>
                                <li class="italic text-secondary">Bisa melihat status akun</li>
                                <li class="italic text-secondary">Bisa melihat status laporan</li>
                                <li class="italic text-secondary">Bisa melihat tanggapan petugas</li>
                            </ol> 
                        </p>
                    </div>
                    <h2 class="accordion-header">Berapa lama laporan saya akan ditindaklanjuti?</h2>
                    <div class="accordion-content">
                        <p class="italic text-secondary">
                            Petugas akan secepatnya menindaklanjuti laporan setelah laporan di verifikasi
                        </p>
                    </div>
                </div>
            </div>

            <div class="acc" id="accordioncontent2">
                <div class="accordion" style="display: none;" id="accordion2">
                    <h5>Apakah setelah register saya bisa membuat pengaduan ?</h5>
                    <p class="italic text-secondary">Setelah melakukan Register, anda bisa langsung membuat pengaduan. Hanya saja pengaduan anda belum
                        bisa langsung ditindaklanjuti selama akun anda belum diverifikasi. Maka setelah register,
                        lengkapi profile akun anda dengan menginput data:
                        <ul>
                            <li class="italic text-secondary">Alamat</li>
                            <li class="italic text-secondary">No.Telp</li>
                            <li class="italic text-secondary">Tanggal Lahir</li>
                            <li class="italic text-secondary">Foto KTP</li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-9">

        </div> --}}
    </div>
</div>

@endsection