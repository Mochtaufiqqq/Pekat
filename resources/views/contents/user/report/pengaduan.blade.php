@extends('layouts.user.master')


@section('title','Pengaduan Saya')

@section('content')
{{-- Section Header --}}
@include('contents.user.nav')

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
                                            <h5 class="card-title">{{ $pengaduan->count() }}</h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="card-pengaduan-2 text-white mb-3" style="max-width: 18rem;">
                                        <div class="card-header"></div>
                                        <div class="card-body text-dark">
                                            <span class="total">Terverifikasi</span>
                                            <h5 class="card-title">{{ $verif->count() }}</h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="card-pengaduan-3 text-white mb-3" style="max-width: 18rem;">
                                        <div class="card-header"></div>
                                        <div class="card-body text-dark">
                                            <span class="total">Selesai</span>
                                            <h5 class="card-title">{{ $verif->count() }}</h5>

                                        </div>
                                    </div>
                                </div>
                            
                                
                                <div class="mb-3 mt-4 ml-3">
                                    <a class="btn btn-outline-primary rounded-5 mb-2 mr-2 {{ (Request::url() == route('pekat.laporan')) && !request('status') ? 'active' : '' }}" href="{{ route('pekat.laporan') }}">Semua
                                        Pengaduan</a>
                                    <a class="btn btn-outline-primary mb-2 mr-2 {{ request('status') == 'proses' ? 'active' : '' }}" href="{{ route('pekat.laporan', ['status' => 'proses']) }}">Proses</a>
                                    <a class="btn btn-outline-primary mb-2 mr-2 {{ request('status') == 'selesai' ? 'active' : '' }}" href="{{ route('pekat.laporan', ['status' => 'selesai']) }}">Selesai</a>
                                </div>
                            
                                @foreach ($pengaduan as $k => $v)
                                @if(request('status') && $v->status != request('status'))
                                @continue
                                @endif
                                <div class="col-lg-12">
                                    <div class="pengaduan-top">
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
                                    <div class="pengaduan-mid">
                                        <div class="judul-laporan">
                                            {{ $v->judul_laporan }}
                                        </div>
                                        <p>{{ $v->isi_laporan }}</p>
                                    </div>
                                    <div class="pengaduan-bottom">
                                        @if ($v->foto != null)
                                        @foreach (explode('|', $v->foto) as $img)


                                        <img src="/storage/{{ $img }}" alt="{{ 'Gambar '.$v->judul_laporan }}"
                                            class="gambar-lampiran mb-4" data-toggle="modal" data-target="#imageModal"
                                            data-src="/storage/{{ $img }}">
                                        @endforeach

                                        @endif
                                        @if ($v->lokasi_kejadian != '')
                                        <p>
                                            <i class="fas fa-map-marker-alt"></i> <small
                                                class="text-muted">{{ $v->lokasi_kejadian }}</small>
                                        </p>
                                        @endif
                                        @if ($v->status == 0)
                                        <p class="mt-3 mb-2">
                                            <a href="/pengaduan/me/edit/{{ $v->id_pengaduan }}">Edit</a>
                                            <a class="ml-3" data-toggle="modal" data-target="#modalDelete{{ $v->id_pengaduan }}"
                                                href="/pengaduan/me/delete/{{ $v->id_pengaduan }}">Hapus</a>

                                               
                                        </p>
                                        @endif

                                        @if ($v->tanggapan != null)
                                        <hr>
                                        <p>
                                            <button class="myTanggapan"><i class="far fa-comment"></i> <small>Tanggapan
                                                    Petugas</small></button>
                                        </p>
                                        <div class="tanggapanContent" style="display: none;">

                                            <p class=" mb-1">
                                                {{ '*Tanggapan dari '. $v->tanggapan->petugas->nama_petugas }}</p>
                                            <p class="light">{{ $v->tanggapan->tanggapan }}</p>

                                        </div>
                                        @endif

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
                    <a class="menu-right" href="/ubah/password"><i class="fa fa-lock my-2"></i>
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

{{-- modal delete --}}
@foreach ($pengaduan as $k => $v)
<div class="modal fade" tabindex="-1" role="dialog" id="modalDelete{{ $v->id_pengaduan }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus pengaduan ini ? </p>
            </div>
            <div class="modal-footer">
                <form action="/pengaduan/me/delete/{{ $v->id_pengaduan }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-primary">Yakin</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal image -->

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-ctn">
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </div>
</div>

{{-- end modal image --}}



@endsection

@section('js')
@if (Session::has('pesan'))
<script>
    $('#loginModal').modal('show');
</script>

@endif

@if (Session::has('success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif

{{-- modal delete --}}


{{-- end modal delete --}}
@endsection