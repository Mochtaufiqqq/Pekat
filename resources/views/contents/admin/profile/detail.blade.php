@extends('layouts.admin.master')

@section('title','Profil Saya')

@section('content')
<div class="container-fluid">
    <div class="edit-profile">
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">Profil Saya</h4>
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
                                            src="/admins/images/dashboard/1.png">
                                        <div class="media-body">
                                            <a href="">
                                                <h3 class="mb-1 f-20 txt-primary">
                                                    {{ Auth::guard('admin')->user()->username }}</h3>
                                            </a>
                                            <p class="f-12">({{ Auth::guard('admin')->user()->nama_petugas }})</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h6 class="form-label text-primary">Email</h6>
                                <small>{{ Auth::guard('admin')->user()->email }}</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-primary">Telp</label>
                                <p>{{ Auth::guard('admin')->user()->telp }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-primary">Alamat</label>
                                <p>{{ Auth::guard('admin')->user()->alamat }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-primary">Level</label>
                                <p>{{ Auth::guard('admin')->user()->level }}</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <form action="/admin/profile/me/update/{{ $petugas->id_petugas }}" class="card" method="POST">
                    @csrf
                    @method('put')
                    {{-- <input type="hidden" name="id_pengaduan" value="{{ $pengaduan->id_pengaduan }}"> --}}
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">Edit Profil</h4>
                        <div class="card-options"><a class="card-options-collapse" href="#"
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
                                        <label class="form-label">Nama</label>
                                        <input class="form-control" type="text" name="nama_petugas" id=""
                                            value="{{ Auth::guard('admin')->user()->nama_petugas }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ Auth::guard('admin')->user()->email }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Telp</label>
                                        <input type="number" class="form-control" name="telp"
                                            value="{{ Auth::guard('admin')->user()->telp }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea name="alamat" id="" rows="2" class="form-control"
                                            value="{{ Auth::guard('admin')->user()->alamat }}">{{ Auth::guard('admin')->user()->alamat }}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary form-control text-white" type="submit">Update</button>
                        </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row mb-0">
        <div class="col-12 mb-0">
            <div class="card">
            <div class="card-header pb-0">
                <h4 class="card-title mb-0">Ubah Password</h4>
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
                    <form action="/admin/profile/me/update/password/{{ $petugas->id_petugas }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group mb-2">
                            <label for="password">Masukan Password Lama</label>
                            <input type="password" name="old_password" class="form-control">
                            @if ($errors->has('old_password'))
                            <div class="text-danger">{{ $errors->first('old_password') }}</div>
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <label for="password">Masukan Password Baru</label>
                            <input type="password" name="new_password" class="form-control">
                            @if ($errors->has('new_password'))
                            <div class="text-danger">{{ $errors->first('new_password') }}</div>
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <label for="password">Konfirmasi Password</label>
                            <input type="password" name="new_password_confirmation" id="" class="form-control">
                            @if ($errors->has('new_password'))
                            <div class="text-danger">{{ $errors->first('new_password') }}</div>
                            @endif
                        </div>
                    </div>
                <div class="card-footer">
                    <button class="btn btn-primary text-white" type="submit">Ubah</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection