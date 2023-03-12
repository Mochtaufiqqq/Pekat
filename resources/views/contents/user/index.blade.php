@extends('layouts.user.master')


@section('title','Layanan Pengaduan Masyarakat')


@section('content')
{{-- Section Header --}}
@include('contents.user.navwave')
{{-- Section Card Pengaduan --}}

<div class="row justify-content-center">
    <div class="col-lg-10 col-10 col">
        <div class="content shadow mb-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-subtitle mb-3">Jumlah Akun Terdaftar</h5>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="d-flex">
                                        <div class="icon" style="background-color: #83e45f; width: 11px; height: 11px;
                                        border-radius: 50%; margin-top: 10px;"></div>
                                        <h2 class="mb-2 counter ml-2" data-max="{{ $verif }}">0</h2>
                                    </div>
                                    <p class="mb-2 text-muted">Terverifikasi</p>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="d-flex">
                                        <div class="icon" style="background-color: #fd4d31; width: 11px; height: 11px;
                                        border-radius: 50%; margin-top: 10px;"></div>
                                        <h2 class="mb-2 counter ml-2" data-max="{{ $nonverif }}">0</h2>
                                    </div>
                                    <p class="mb-2 text-muted">Belum Terverifikasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-subtitle text-center mb-3">Pengaduan</h4>
                            <div class="d-flex justify-content-center">
                                <div class="icon" style="background-color: #36baff; width: 11px; height: 11px;
                                border-radius: 50%; margin-top: 10px;"></div>
                                <h2 class="mb-2 text-center counter ml-2" data-max="{{ $cp->count() }}">0</h2>
                                
                            </div>
                            <p class="mb-0 text-muted text-center">Total Pengaduan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-subtitle mb-3 text-center">Ditanggapi</h4>
                            <div class="d-flex justify-content-center">
                                <div class="icon" style="background-color: #3cae12; width: 11px; height: 11px;
                                border-radius: 50%; margin-top: 10px;"></div>
                                <h2 class="mb-2 counter text-center ml-2" data-max="{{ $ditanggapi }}">0</h2>
                            </div>
                            <p class="mb-0 text-muted text-center">Sudah Ditanggapi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container">
    <div class="content">
        <h5 class="mb-4">Semua Laporan</h5>


        @foreach ($pengaduan as $k => $v)

        <div class="myShadow shadow">
            <div class="laporan-top">
                @if ($v->hide_identitas == 2)
                <img src="{{ asset('/images/anonim.png') }}" alt="profile" class="profile">

                @elseif($v->user->foto_profil)
                <img src="{{ asset($v->user->foto_profil) }}" alt="profile" class="profile gambar-lampiran"
                    data-toggle="modal" data-target="#imageModal" data-src="{{ asset($v->user->foto_profil) }}">

                @else
                <img src="{{ asset('/images/user_default.svg') }}" alt="profile" class="profile">
                @endif
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
                        <p class="text-warning">Diproses</p>
                        @else
                        <p class="text-success">Selesai</p>
                        @endif
                    </div>
                    
                    <div>
                        <p>{{ $v->tgl_pengaduan->format('d,M,Y')  }}</p>
                    </div>
                </div>
            </div>
            <div class="laporan-mid">
                <div class="judul-laporan">
                    {{ $v->judul_laporan }}
                </div>
                <p class="isi-laporan">{{ Str::limit($v->isi_laporan,200) }}</p>
            </div>
            <div class="laporan-bottom">

                @if ($v->Images != '')
                @foreach ($v->Images as $key => $item)

                <img src="{{ asset('storage/complaint-images/' .$item->folder. '/' .$item->image) ?? ''}}"
                    class="gambar-lampiran mb-0" data-toggle="modal" data-target="#imageModal"
                    data-src="{{ asset('/storage/complaint-images/' .$item->folder. '/' .$item->image) ?? '' }}">

                @endforeach
                @endif
                @if ($v->Location && $v->Location->location)
                <a href="https://www.google.com/maps/search/?api=1&query={{ $v->Location->latitude }},{{ $v->Location->longitude }}"> 
                    <p><i class="fas fa-map-marker-alt"></i> 
                    <small class="text-muted">{{ $v->Location->location ?? '' }}</small>
                    </p>
                  </a>
                @endif
                <a style="text-decoration: none; font-size: 15px;" href="/pengaduan/detail/{{ $v->id_pengaduan }}">Lihat Detail</a>
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

<!-- Modal image -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-ctn">
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="" style="width: 100%; height: auto;">
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


@endsection