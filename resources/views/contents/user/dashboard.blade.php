@extends('layouts.user.master')


@section('content')

@section('title','Dashboard')
    

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
        <h2 class="medium text-white mt-3">Layanan Pengaduan Masyarakat Desa Sangkanhurip</h2>
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
            <div class="alert alert-danger" role="alert">
                *Lengkapi profil anda sebelum mengirim pengaduan
            </div>
            {{-- <div class="card mb-3">Tulis Laporan Disini</div> --}}
            <form action="{{ route('pekat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <input type="hidden" name="longitude" value="longitude" id="longitude">
                <input type="hidden" name="latitude" value="latitude" id="latitude">

                <div class="form-group">
                    <label class="text-sm" for="judul_laporan">Judul Laporan</label>
                    <input class="form-control" type="text" name="judul_laporan" placeholder="Masukan Judul Laporan">
                </div>
                <div class="form-group">
                    <label class="text-sm" for="isi_laporan">Isi Laporan</label>
                    <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control"
                        rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label class="text-sm" for="tgl_pengaduan">Tanggal Kejadian</label>
                    <input name="tgl_pengaduan" type="date" id="datepicker" class="form-control"
                        placeholder="Tanggal laporan">
                </div>
                <div class="form-group">
                    <label class="text-sm" for="tgl_pengaduan">Lokasi Kejadian</label>
                    <textarea class="form-control" name="lokasi_kejadian" id="address" rows="2" placeholder="Lokasi kejadian"></textarea>
                </div>
                <div id="locationContent" class="mb-3">
                <div id="leafletMap-registration" style=""></div>
            </div>
                   
                <div class="mb-3">
                    <a id="myButton"><i class="fas fa-paperclip" style="text-decoration: none; "></i> Lampiran</a>
                </div>
                
                <div class="form-group" id="myContent" style="display: none;">
                    <div class="drop-container">
                        <span class="drop-title">Seret file ke sini</span>
                        atau
                        <input type="file" id="images" name="image[]" accept="image/*" multiple>
                    </div>
                      
                </div>
                
               <hr>
                <div class="form-check">
                    <div class="row text-center mb-3">
                    <div class="col-6">
                    <input type="checkbox" name="hide_identitas" value="2" class="form-check-input"  data-toggle="tooltip" data-placement="top" title="Nama anda tidak akan terpublish">
                    <label class="form-check-label" for="exampleCheck1">Anonim</label>
                    
                </div>
                <div class="col-6">
                    <input type="checkbox" name="hide_laporan" value="2" class="form-check-input"  data-toggle="tooltip" data-placement="top" title="Laporan anda tidak dapat dilihat publik">
                    <label class="form-check-label" for="exampleCheck1">Rahasia</label>
                </div>
                </div>
                
                </div>
                  <div class="text-center mt-3">
                    <button type="submit" class="btn btn-custom mt-2">Kirim</button>
                </div>
                {{-- <form action="/upload" class="dropzone" id="my-dropzone"></form>
                
            </form> --}}
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



<!-- Button trigger modal -->

  
  
{{-- <script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4'
    });
</script> --}}
@endsection