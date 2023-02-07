@extends('layouts.user.master')


@section('title','Pengaduan Saya')

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
                            <a class="nav-link ml-3 text-white" href="/dashboard">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link ml-4 dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              {{ Auth::guard('masyarakat')->user()->nama }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="#">Profil Saya</a>
                              <a class="dropdown-item" href="#">Laporan Saya</a>
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

<section>
<div class="container">
    
    <div class="row justify-content-center">
        
        <div class="col-lg-8 col-md-12 col-sm-12 col-12 col">
           
            <div class="menu menu-top shadow">
                <div>
                    <h5 class="mb-2">Pengaduan saya</h5>
                    <hr>
                    <div class="row">
                    <div class="col-md-5">
                        <div class="card-pengaduan1 text-white mb-3" style="max-width: 18rem;">
                            <div class="card-header"></div>
                            <div class="card-body text-dark">
                                <span class="total">Total Pengaduan</span>
                              <h5 class="card-title">123</h5>
                              
                            </div>
                          </div>
                    </div>
                    <div class="col-md-3 ms-5">
                        <div class="card-pengaduan-2 text-white mb-3" style="max-width: 18rem;">
                            <div class="card-header"></div>
                            <div class="card-body text-dark">
                                <span class="total">Terverifikasi</span>
                              <h5 class="card-title">123</h5>
                              
                            </div>
                          </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-pengaduan-3 text-white mb-3" style="max-width: 18rem;">
                            <div class="card-header"></div>
                            <div class="card-body text-dark">
                                <span class="total">Selesai</span>
                              <h5 class="card-title">123</h5>
                              
                            </div>
                          </div>
                    </div>
                    
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-12 col">
            <div class="menu menu-top shadow">
                <h5>Menu</h5>
                <hr>
              <a href="/laporan/me" style="text-decoration: none; color:black;"> <i class="fa fa-file my-2"></i>  <small>Laporan saya</small></a>
                <hr>
                <a href="/laporan" style="text-decoration: none; color:black;"><i class="fa fa-lock my-2"></i>  <small>Ubah Password</small></a>
                <hr>
               <a href="/logout" style="text-decoration: none; color:black;"> <i class="fa fa-sign-out my-2"></i>  <small>Logout</small></a>
            </div>
        </div>
    </div>
</div>
</section>

@endsection

@section('js')
@if (Session::has('pesan'))
<script>
    $('#loginModal').modal('show');
</script>

@endif
@endsection