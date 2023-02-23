@extends('layouts.user.master')


@section('title','Kontak Kami')

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
                            <a class="nav-link ml-3 text-white" href="/dashboard">Home</a>
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
        <h2 class="medium text-white help">Hubungi Kami</h2>
        {{-- <hr class="tb"> --}}
    </div>

</section>

<div class="container">
    <div class="mt-4 mb-4">
        <h5>Kontak Kami</h5>
    </div>
    <div class="contact">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.0714699480964!2d107.55904621499539!3d-7.000865994942776!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68eebabe1b67a9%3A0xaa90a7a88ca077f1!2sKantor%20Kecamatan%20Katapang!5e0!3m2!1sen!2sid!4v1676960957458!5m2!1sen!2sid"
                    width="500" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                   <p class="italic mb-0"><i class="fas fa-map-marker-alt"></i>Jl. Katapang Andir No.Km. 1, RW.5, Sangkanhurip, Kec. Katapang, Kabupaten Bandung, Jawa Barat 40921</p>
                   <p class="italic"><i class="fas fa-call"></i> 0225893325</p>
                   <p class="italic"><i class="fas fa-envelope"></i> kecamatankatapang@gmail.com</p>
                
            </div>

            <div class="col-md-6">
                @if (Session::has('success'))

                <div class="alert alert-success">{{ Session::get('success') }}</div>
                    
                @endif
                <form action="/contact-us" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea name="message" rows="10" class="form-control" placeholder="Pesan"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn" style="background-color: #0a2647; color: white; width: 30%;">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection