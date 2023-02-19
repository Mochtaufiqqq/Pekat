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
                                    <h2 class="mb-2 counter" data-max="{{ $verif }}">0</h2>
                                    <p class="mb-2 text-muted">Terverifikasi</p>
                                </div>
                                <div class="col-sm-6">
                                    <h2 class="mb-2 counter" data-max="{{ $nonverif }}">0</h2>
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
                            <h2 class="mb-2 text-center counter" data-max="{{ $cp->count() }}" >0</h2>
                            <p class="mb-0 text-muted text-center">Total Pengaduan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-subtitle mb-3 text-center">Ditanggapi</h4>
                            <h2 class="mb-2 counter text-center" data-max="10">0</h2>
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
                @foreach (explode('|', $v->foto) as $img)


                <img src="/storage/{{ $img }}" alt="{{ 'Gambar '.$v->judul_laporan }}"
                    class="gambar-lampiran mb-4" data-toggle="modal" data-target="#imageModal"
                    data-src="/storage/{{ $img }}">
                @endforeach
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


@endsection