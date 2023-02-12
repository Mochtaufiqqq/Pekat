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
                                            src="/admins/images/user/7.jpg">
                                        <div class="media-body">
                                            <a href="/admin/masyarakat/detail/{{ $pengaduan->user->nik }}"><h3 class="mb-1 f-20 txt-primary">{{ $pengaduan->user->username }}</h3></a>
                                            <p class="f-12">({{ $pengaduan->user->nik }})</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h6 class="form-label text-primary">Isi Laporan</h6>
                               <small>{{ $pengaduan->isi_laporan }}</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-primary">Nama Pelapor</label>
                               <p>{{ $pengaduan->user->nama }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-primary">Tanggal Laporan</label>
                                <p>{{ $pengaduan->tgl_pengaduan }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-primary">Foto Laporan</label>
                                <div class="gallery my-gallery card-body row" itemscope="" data-pswp-uid="1" id="aniimated-thumbnials">
                                    @foreach (explode('|', $pengaduan->foto) as $img)
                                    <figure class="col-xl-3 col-md-4 xl-33" itemprop="associatedMedia" itemscope="">
                                        <a href="/storage/{{ $img }}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="/storage/{{ $img }}" itemprop="thumbnail" alt="Image description"></a>
                                      <figcaption itemprop="caption description">Image caption  1</figcaption>
                                    </figure>
                                    @endforeach
                                  </div>
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