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
                            <a class="nav-link ml-4 dropdown-toggle text-white" href="#" id="navbarDropdown"
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
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="card-pengaduan1 text-white mb-3" style="max-width: 18rem;">
                                        <div class="card-header"></div>
                                        <div class="card-body text-dark">
                                            <span class="total">Total Pengaduan</span>
                                            <h5 class="card-title">123</h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="card-pengaduan-2 text-white mb-3" style="max-width: 18rem;">
                                        <div class="card-header"></div>
                                        <div class="card-body text-dark">
                                            <span class="total">Terverifikasi</span>
                                            <h5 class="card-title">123</h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="card-pengaduan-3 text-white mb-3" style="max-width: 18rem;">
                                        <div class="card-header"></div>
                                        <div class="card-body text-dark">
                                            <span class="total">Selesai</span>
                                            <h5 class="card-title">123</h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <a class="d-inline tab mr-4" href="">
                                        Semua Pengaduan
                                    </a>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <a class="d-inline tab mr-4" href="">
                                        Semua Pengaduan
                                    </a>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <a class="d-inline tab mr-4" href="">
                                        Semua Pengaduan
                                    </a>
                                </div>
                                    <hr>
                                

                                @foreach ($pengaduan as $k => $v)
                                <div class="col-lg-12" >
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
                                        @foreach (explode('|', $v->foto) as $img)


                                        <img src="/storage/{{ $img }}" alt="{{ 'Gambar '.$v->judul_laporan }}"
                                            class="gambar-lampiran" data-toggle="modal" data-target="#imageModal">
                                        @endforeach

                                        @endif
                                        @if ($v->status == 0)
                                        <p class="mt-3 mb-1">
                                            <a href="/pengaduan/me/edit/{{ $v->id_pengaduan }}">Edit</a>
                                            <a class="ml-3" data-toggle="modal"
                                                data-target="#modalDelete{{ $v->id_pengaduan }}"
                                                href="/pengaduan/me/delete/{{ $v->id_pengaduan }}">Hapus</a>
                                        </p>
                                        @endif

                                        <p class="mt-3 mb-1">opik
                                        </p>
                                        <p class="light">Petugas sudah turun ke lapangan</p>

                                    </div>
                                    <hr>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-sm-12 col-12 col">
                <div class="menu menu-top shadow">
                    <h5>Menu</h5>
                    <hr>
                    <a class="menu-right {{ $active != 'profile' ? '' : 'menu-active'}}" href="/profile"> <i
                            class="fa fa-user my-2"></i>
                        <small class="ml-2">Profil saya</small>
                    </a>
                    <hr>
                    <a class="menu-right {{ $active == 'me' ? '' : 'menu-active'}}" href="/pengaduan/me"> <i
                            class="fa fa-file my-2"></i>
                        <small class="ml-2">Laporan saya</small>
                    </a>
                    <hr>
                    <a class="menu-right" href="/laporan"><i class="fa fa-lock my-2"></i>
                        <small class="ml-2">Ubah Password</small>
                    </a>
                    <hr>
                    <a class="menu-right" href="/logout"> <i class="fa fa-sign-out my-2"></i>
                        <small class="ml-2">Logout</small>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>



<!-- Modal image -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="" class="img-responsive" id="imagePreview">
            </div>
        </div>
    </div>
</div>
{{-- end modal image --}}

{{-- modal delete --}}
<div class="modal fade" id="modalDelete{{ $v->id_pengaduan }}" tabindex="-1" role="dialog"
    aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus
                    Pengaduan</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus laporan ini ?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                <form action="/pengaduan/me/delete/{{ $v->id_pengaduan }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-primary" type="submit">Yakin</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- end modal delete --}}
@endsection

@section('js')
@if (Session::has('pesan'))
<script>
    $('#loginModal').modal('show');
</script>

@endif
@endsection