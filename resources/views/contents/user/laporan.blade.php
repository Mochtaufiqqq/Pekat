@extends('layouts.user.master')


@section('title', 'PEKAT - Pengaduan Masyarakat')

@section('content')
{{-- Section Header --}}
<section class="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('pekat.index') }}">
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
                            <a class="nav-link ml-3 text-white" href="{{ route('pekat.laporan') }}">Laporan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="{{ route('pekat.logout') }}"
                                style="text-decoration: underline">{{ Auth::guard('masyarakat')->user()->nama }}</a>
                        </li>
                    </ul>
                    @else
                    <ul class="navbar-nav text-center ml-auto">
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

</section>

{{-- Section Card --}}
<div class="container">
    <div class="row justify-content-between">
        <div class="col-lg-8 col-md-12 col-sm-12 col-12 col">
            <div class="menu menu-top shadow">
                <div>
                    <h5 class="mb-2">Profile saya</h5>
                    <hr>
                    <img src="{{ asset('images/user_default.svg') }}" alt="user profile" class="photo">
                    <div class="self-align">
                        <h5><a style="color: #6a70fc" href="#">{{ Auth::guard('masyarakat')->user()->nama }}</a></h5>
                        <p class="text-dark">{{ Auth::guard('masyarakat')->user()->username }}</p>
                    </div>

                </div>
                <div class="mt-5">
                    <a class="d-inline tab" id="tab1" onclick="showForm('form1')">
                        Informasi Publik
                    </a>
                    <a class="d-inline tab" id="tab2" onclick="showForm('form2')">
                        Informasi Pribadi
                    </a>
                    <hr>
                </div>
                <div class="mt-2 mb-4">
                    <small>Bagian <small style="color: red"> (*) </small>Dibutuhkan</small>
                </div>
                <div class="form mb-2" id="content1">
                    <form action="" id="form1" style="display: block">
                        <div class="form-group">
                            <small class="text-muted">Username <small style="color: red"> (*) </small></small>
                            <input class="form-control" type="text" placeholder="username"
                                value="{{ Auth::guard('masyarakat')->user()->username }}">
                        </div>
                        <div class="form-group">
                            <small class="text-muted">Nama lengkap <small style="color: red"> (*) </small></small>
                            <input class="form-control" type="text" placeholder="asasd"
                                value="{{ Auth::guard('masyarakat')->user()->nama }}">
                        </div>
                        <div class="form-group">
                            <small class="text-muted">Email <small style="color: red"> (*) </small></small>
                            <input class="form-control" type="email" placeholder="asasd"
                                value="{{ Auth::guard('masyarakat')->user()->email }}">
                        </div>
                        <div class="form-check">
                            <div class="row text-center mb-3">
                                <div class="col-6">
                                    <input type="radio" id="flexRadioDefault1">
                                    <label class="form-check-label" for="exampleCheck1">Laki laki</label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" id="flexRadioDefault2">
                                    <label class="form-check-label" for="exampleCheck1">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-custom mt-2" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="Tooltip on top">Update</button>
                        </div>
                    </form>
                </div>
                <div class="form mb-2" id="content2">
                    <form action="/update/{{ Auth::guard('masyarakat')->user()->nik }}" method="POST" id="form2"
                        style="display: none;" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <small class="text-muted">No Handphone <small style="color: red"> (*) </small></small>
                            <input class="form-control" type="number" id="inputNumber" name="telp" placeholder="No Telp"
                                value="{{ Auth::guard('masyarakat')->user()->telp }}">
                        </div>
                        <div class="form-group">
                            <small class="text-muted">Tanggal Lahir <small style="color: red"> (*) </small></small>
                            <input class="form-control" name="tgl_lahir"
                                value="{{ Auth::guard('masyarakat')->user()->tgl_lahir }}" type="date"
                                placeholder="asasd">
                        </div>
                        <div class="form-group">
                            <small class="text-muted">Foto KTP <small style="color: red"> (*) </small></small>
                            @if (Auth::guard('masyarakat')->user()->foto_ktp)
                            <img src="{{ asset(Auth::guard('masyarakat')->user()->foto_ktp) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                            @else
                            <img class="img-preview img-fluid mb-3 col-sm-5">
                            @endif
                            <img class="img-preview img-fluid mb-3">
                            
                            <input type="file" name="foto" id="image"
                                class="form-control @error('foto') is-invalid @enderror" onchange="previewImage()">
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-custom mt-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-12 col">
            <div class="menu menu-top shadow">
                <h5>Menu</h5>
                <hr>
              <a href="/laporan" style="text-decoration: none; color:black;"> <i class="fa fa-file my-2"></i>  <small>Laporan saya</small></a>
                <hr>
                <a href="/laporan" style="text-decoration: none; color:black;"><i class="fa fa-lock my-2"></i>  <small>Ubah Password</small></a>
                <hr>
               <a href="/logout" style="text-decoration: none; color:black;"> <i class="fa fa-sign-out my-2"></i>  <small>Logout</small></a>
            </div>
        </div>
    </div>


    <div class="row mt-5">
        <div class="col-lg-8">
            <a class="d-inline tab {{ $siapa != 'me' ? 'tab-active' : ''}} mr-4" href="{{ route('pekat.laporan') }}">
                Semua
            </a>
            <a class="d-inline tab {{ $siapa == 'me' ? 'tab-active' : ''}}" href="{{ route('pekat.laporan', 'me') }}">
                Laporan Saya
            </a>
            <hr>
        </div>
        @foreach ($pengaduan as $k => $v)
        <div class="col-lg-8">
            <div class="laporan-top">
                <img src="{{ asset('images/user_default.svg') }}" alt="profile" class="profile">
                <div class="d-flex justify-content-between">
                    <div>
                        @if ($v->hide_laporan == 2)
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
                        <p>{{ $v->tgl_pengaduan->format('d M, h:i') }}</p>
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
                <img src="{{ Storage::url($v->foto) }}" alt="{{ 'Gambar '.$v->judul_laporan }}" class="gambar-lampiran">
                @endif
                @if ($v->tanggapan != null)
                <p class="mt-3 mb-1">{{ '*Tanggapan dari '. $v->tanggapan->petugas->nama_petugas }}</p>
                <p class="light">{{ $v->tanggapan->tanggapan }}</p>
                @endif
            </div>
            <hr>
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
@endsection