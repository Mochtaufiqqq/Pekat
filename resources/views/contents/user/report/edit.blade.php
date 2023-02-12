@extends('layouts.user.master')


@section('content')

@section('title','Edit Pengaduan')
    

{{-- Section Header --}}
<section class="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <h4 class="semi-bold mb-0 text-white">PEKAT</h4>
                    <p class="italic mt-0 text-white">Pengaduan Masyarakat</p>

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    @if(Auth::guard('masyarakat')->check())

                    <ul class="navbar-nav text-center ml-auto">
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="/dashboard">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link ml-4 dropdown-toggle text-white" href="/profile" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              {{ Auth::guard('masyarakat')->user()->nama }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="/profile">Profil Saya</a>
                              <a class="dropdown-item" href="/laporan/me">Laporan Saya</a>
                              {{-- <a class="dropdown-item" href="#">Ubah Password</a> --}}
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="/logout">Keluar</a>
                            </div>
                          </li>
                    </ul>
                    @else
                    <ul class="navbar-nav text-center ml-auto">
                        <li class="nav-item">
                            <button class="btn text-white" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#loginModal">Tentang kami</button>
                        </li>
                        <li class="nav-item">
                            <button class="btn text-white" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#loginModal">Hubungi kami</button>
                        </li>
                        <li class="nav-item">
                            <button class="btn text-white" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#loginModal">Masuk</button>
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

    <div class="text-center">
        <h2 class="medium text-white mt-3">Layanan Pengaduan Masyarakat Desa Rancamanyar</h2>
        <p class="italic text-white mb-5">Sampaikan laporan anda</p>
    </div>

    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div>
</section>
{{-- Section Card Pengaduan --}}

<div class="row justify-content-center">
    <div class="col-lg-6 col-10 col">
        <div class="content shadow">

            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            @endif

            @if (Session::has('pengaduan'))
            <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('pengaduan') }}</div>
            @endif

            <div class="card mb-3">Edit Pengaduan</div>
            <form action="/pengaduan/me/update/{{ $pengaduan->id_pengaduan }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf

                <div class="form-group">
                    <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control"
                        rows="4">{{ old('isi_laporan') }}</textarea>
                </div>
                <div class="form-group">
                    <input name="tgl_pengaduan" type="date" id="datepicker" class="form-control"
                        placeholder="Tanggal laporan">
                </div>
                <div class="form-group">
                    <textarea name="lokasi_kejadian" placeholder="Masukan lokasi kejadian" class="form-control"
                    rows="2">{{ old('lokasi_kejadian') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="images" class="drop-container">
                        <span class="drop-title">Drag files here</span>
                        or
                        <input type="file" name="images[]" id="images" accept="image/*" multiple>
                    </label>
                </div>
                <div class="form-check">
                    <div class="row text-center mb-3">
                    <div class="col-6">
                    <input type="checkbox" name="hide_identitas" value="2" class="form-check-input" id="exampleCheck1" data-toggle="tooltip" data-placement="top" title="Nama anda tidak akan terpublish">
                    <label class="form-check-label" for="exampleCheck1">Anonymous</label>
                </div>
                <div class="col-6">
                    <input type="checkbox" name="hide_laporan" value="2" class="form-check-input" id="exampleCheck1" data-toggle="tooltip" data-placement="top" title="Laporan anda tidak dapat dilihat publik">
                    <label class="form-check-label" for="exampleCheck1">Rahasia</label>
                </div>
                </div>
                </div>
                  <div class="text-center mt-3">
                    <button type="submit" class="btn btn-custom mt-2" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="Tooltip on top">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Section Hitung Pengaduan --}}
<div class="pengaduan mt-5">
    <div class="bg-purple">
        <div class="text-center">
            <h5 class="medium text-white mt-3">JUMLAH LAPORAN SEKARANG</h5>
            <h2 class="medium text-white">10</h2>
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="mt-3">Masuk terlebih dahulu</h3>
                <p>Silahkan masuk menggunakan akun yang sudah didaftarkan.</p>
                <form action="{{ route('pekat.login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-purple text-white mt-3" style="width: 100%">MASUK</button>
                </form>
                @if (Session::has('pesan'))
                <div class="alert alert-danger mt-2">
                    {{ Session::get('pesan') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@if (Session::has('pesan'))
<script>
    $('#loginModal').modal('show');
</script>
@endif
{{-- <script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4'
    });
</script> --}}
@endsection