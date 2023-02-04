@extends('layouts.admin.master')

@section('title','Detail Pengaduan')

@section('content')
<div class="container-fluid">
    <div class="edit-profile">
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">My Profile</h4>
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
                                            src="/admins/images/user/7.jpg">
                                        <div class="media-body">
                                            <h3 class="mb-1 f-20 txt-primary">MARK JECNO</h3>
                                            <p class="f-12">DESIGNER</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h6 class="form-label">Isi Laporan</h6>
                                <span class="text text-end">Isi laporan</span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Pelapor</label>
                                <span class="text">Moch</span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Laporan</label>
                                <span class="text">09089</span>
                            </div>
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
                <form action="/admin/tanggapan/createOrUpdate" class="card" method="POST">
                    @csrf
                    <input type="hidden" name="id_pengaduan" value="{{ $pengaduan->id_pengaduan }}">
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">Beri Tanggapan</h4>
                        <div class="card-options"><a class="card-options-collapse" href="#"
                                data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                    class="fe fe-x"></i></a></div>
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
                                <div>
                                    <label class="form-label">Tanggapan</label>
                                    <textarea class="form-control" name="tanggapan" rows="5"
                                        placeholder="Beri tanggapan">{{ $tanggapan->tanggapan ?? '' }}</textarea>
                                </div>
                            </div>
                            @if (session('success'))
                            <div class="alert alert-primary alert-dismissible fade show" role="alert"><strong>Selamat !
                                </strong>
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                                    data-bs-original-title="" title=""></button>
                                {{ session('success') }}
                            </div>
                            @endif
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
@endsection