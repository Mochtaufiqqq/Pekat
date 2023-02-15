@extends('layouts.user.master')


@section('content')
{{-- Section Header --}}
<section class="header">
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
                            <a class="nav-link ml-3 text-white" href="{{ route('pekat.laporan') }}">Laporan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="{{ route('pekat.logout') }}"
                                style="text-decoration: underline">{{ Auth::guard('masyarakat')->user()->nama }}</a>
                        </li>
                    </ul>
                    @else
                    <ul class="navbar-nav text-center ml-auto">
                        {{-- <li class="nav-item">
                            <button class="btn text-white" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#loginModal">Tentang kami</button>
                        </li> --}}
                        <li class="nav-item">
                            <button class="btn text-white" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#loginModal">Hubungi kami</button>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link ml-2 dropdown-toggle text-white" href="/profile" id="navbarDropdown"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Masuk
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/login">Masuk sebagai masyarakat</a>
                                <a class="dropdown-item" href="/loginadmin">Masuk sebagai admin</a>
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

    @include('contents.user.wave')

</section>
{{-- Section Card Pengaduan --}}

<div class="row justify-content-center">
    <div class="col-lg-10 col-10 col">
        <div class="content shadow mb-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-subtitle mb-2">Jumlah Akun Terdaftar</h5>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2 class="mb-2">450</h2>
                                    <p class="mb-0 text-muted">Terverifikasi</p>
                                </div>
                                <div class="col-sm-6">
                                    <h2 class="mb-2">450</h2>
                                    <p class="mb-0 text-muted">Belum Terverifikasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-subtitle mb-2">Pengaduan</h4>
                            <h2 class="mb-2">450</h2>
                            <p class="mb-0 text-muted">Total Pengaduan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-subtitle mb-2 ">Ditanggapi</h4>
                            <h2 class="mb-2" id="count" value="20">20</h2>
                            <p class="mb-0 text-muted">Sudah Ditanggapi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container">
    <div class="content">
        <h5>Semua Laporan</h5>
        <hr>

        @foreach ($pengaduan as $k => $v)

        <div class="myShadow shadow">
            <div class="laporan-top">
                <img src="{{ asset('images/user_default.svg') }}" alt="profile" class="profile">
                <div class="d-flex justify-content-between">
                    <div>
                        @if ($v->hide_identitas == 2)
                        <p>Anonymous</p>
                        @else
                        <p>{{ $v->user->nama }}</p>
                        @endif
                        @if ($v->status == '0')
                        <p class="text-danger">Pending</p>
                        @elseif($v->status == 'proses')
                        <p class="text-warning">{{ ucwords($v->status) }}</p>
                        @else
                        <p class="text-success">{{ ucwords($v->status) }}</p>
                        @endif
                    </div>
                    <div>
                        <p>{{ $v->tgl_pengaduan->format('h:i, d M, Y ') }}</p>
                    </div>
                </div>
            </div>
            <div class="laporan-mid">
                <div class="judul-laporan">
                    {{ $v->judul_laporan }}
                </div>
                <p>{{ $v->isi_laporan }}</p>
            </div>
            <div class="laporan-bottom">

                @if ($v->foto != null)
                <img src="{{ Storage::url($v->foto) }}" alt="{{ 'Gambar '.$v->judul_laporan }}"
                    class="gambar-lampiran mb-2">
                @endif
                @if ($v->lokasi_kejadian != '')
                <p>
                    <i class="fas fa-map-marker-alt"></i> <small class="text-muted">{{ $v->lokasi_kejadian }}</small>
                </p>
                @endif
                <hr>
                @if ($v->tanggapan->tanggapan != null)
                <p>
                    <button class="myTanggapan"><i class="far fa-comment"></i> <small>Tanggapan Petugas</small></button>
                </p>
                <div class="tanggapanContent" style="display: none;">

                    <p class=" mb-1">
                        {{ '*Tanggapan dari '. $v->tanggapan->petugas->nama_petugas }}</p>
                    <p class="light">{{ $v->tanggapan->tanggapan }}</p>

                </div>

            </div>
            <hr>
            @endif
        </div>
        @endforeach
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