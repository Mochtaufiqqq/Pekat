@extends('layouts.admin.master')

@section('title','Detail Pengaduan')

@section('content')
<div class="container-fluid">
    <div class="edit-profile">
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">Pelapor</h4>
                        <div class="card-options"><a class="card-options-collapse" href="#"
                                data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                    class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-2">
                                <div class="profile-title">
                                    <div class="media"><img class="img-70 rounded-circle" alt=""
                                            src="/images/user_default.svg">
                                        <div class="media-body">
                                            <a href="/admin/masyarakat/detail/{{ $pengaduan->user->nik }}">
                                                <h3 class="mb-1 f-20 txt-primary">{{ $pengaduan->user->username }}  @if ($pengaduan->user->foto_ktp == '' || $pengaduan->user->alamat == '' || $pengaduan->user->email == '' || $pengaduan->user->telp == '')
                                                    <small class="text-danger">!</small>
                                                    
                                                    @else
                                                    <small class="text-succes">✓</small>
                                                    @endif</h3>
                                            </a>
                                            <p class="f-12">({{ $pengaduan->user->nik }})</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-primary">Nama Pelapor</label>
                                <p>{{ $pengaduan->user->nama }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-primary">Judul Laporan</label>
                                <p>{{ $pengaduan->judul_laporan }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-primary">Isi Laporan</label>
                                <p>{{ $pengaduan->isi_laporan }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-primary">Lokasi Kejadian</label>
                                <p>{{ $pengaduan->lokasi_kejadian }}
                                    {{ $pengaduan->latitude }},{{ $pengaduan->longitude }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-primary">Tanggal Laporan</label>
                                <p>{{ $pengaduan->tgl_pengaduan }}</p>
                            </div>

                            @if ($pengaduan->foto != '')
                            <div class="mb-3">
                                <label class="form-label text-primary">Foto Laporan</label>
                                <div class="row">
                                    @foreach (explode('|', $pengaduan->foto) as $img)
                                    <div class="col-sm-3 mb-2">
                                        <img src="/storage/{{ $img }}" 
                                            class="gambar-lampiran" data-bs-toggle="modal" data-bs-target="#imageModal"
                                            data-src="/storage/{{ $img }}" width="100">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                @if ($pengaduan->status == '0')
                                <span class="badge badge-danger">Pending</span>
                                @elseif ($pengaduan->status == 'proses')
                                <span class="badge badge-warning">Proses</span>
                                @else
                                <span class="badge badge-success">Selesai</span>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <form action="/admin/tanggapan/createOrUpdate" class="card" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_pengaduan" value="{{ $pengaduan->id_pengaduan }}">
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">Beri Tanggapan</h4>
                        <div class="card-options mb-2"><a class="card-options-collapse" href="#"
                                data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                    class="fe fe-x"></i></a></div>

                        @if (session('success'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert"><strong>Selamat !
                            </strong>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                                data-bs-original-title="" title=""></button>
                            {{ session('success') }}
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control btn-square">
                                        @if ($pengaduan->status == '0')
                                        <option selected value="0">Pending</option>
                                        <option value="proses">Proses</option>
                                        <option value="selesai">Selesai</option>
                                        @elseif ($pengaduan->status == 'proses')
                                        <option value="0">Pending</option>
                                        <option selected value="proses">Proses</option>
                                        <option value="selesai">Selesai</option>
                                        @else
                                        <option value="0">Pending</option>
                                        <option value="proses">Proses</option>
                                        <option selected value="selesai">Selesai</option>
                                        @endif

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Tanggapan</label>
                                    <textarea class="form-control" name="tanggapan" rows="5"
                                        placeholder="Beri tanggapan">{{ $tanggapan->tanggapan ?? '' }}</textarea>
                                </div>
                            </div>
                            

                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary form-control text-white" type="submit">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- modal image --}}
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
@endsection

@section('js')

<script>
    $(document).ready(function () {
        $('.gambar-lampiran').click(function () {
            var src = $(this).data('src');
            $('#modalImage').attr('src', src);
        });
    });
</script>

@endsection