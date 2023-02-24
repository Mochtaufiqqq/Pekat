@extends('layouts.admin.master')


@section('title','Tambah Petugas')

@section('content')



<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">

                <h3>Tambah Data User</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/petugas">Semua Petugas</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Container-fluid Ends-->

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Lengkapi Form</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="/admin/petugas/store" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 m-form__group">
                                    <label class="form-label">Nama Petugas</label>
                                    <div class="input-group">
                                        <input class="form-control @error('nama_petugas') is-invalid @enderror"
                                            type="text" name="nama_petugas" placeholder="Nama lengkap" value="{{ old('nama_petugas') }}">
                                    </div>
                                    @if ($errors->has('nama_petugas'))
                                    <div class="text-danger">{{ $errors->first('nama_petugas') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3 m-form__group">
                                    <label class="form-label">Username</label>
                                    <div class="input-group">
                                        <input class="form-control @error('username') is-invalid @enderror" type="text"
                                            name="username" placeholder="Username">
                                    </div>
                                    @if ($errors->has('username'))
                                    <div class="text-danger">{{ $errors->first('username') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3 m-form__group">
                                    <label class="form-label">Alamat</label>
                                    <div class="input-group">
                                        <textarea class="form-control @error('email') is-invalid @enderror" name="alamat" id="" rows="2" placeholder="Alamat"></textarea >
                                    </div>
                                    @if ($errors->has('alamat'))
                                    <div class="text-danger">{{ $errors->first('alamat') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3 m-form__group">
                                    <label class="form-label">Email</label>
                                    <div class="input-group">
                                        <input class="form-control @error('email') is-invalid @enderror" type="email"
                                            name="email" placeholder="contoh@gmail.com">
                                    </div>
                                    @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3 m-form__group">
                                    <label class="form-label">Telp</label>
                                    <div class="input-group">
                                        <input class="form-control @error('telp') is-invalid @enderror" type="number"
                                            name="telp" placeholder="contoh:08909890" id="inputNumber">
                                    </div>
                                    @if ($errors->has('telp'))
                                    <div class="text-danger">{{ $errors->first('telp') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group">
                                        <input class="form-control @error('password') is-invalid @enderror"
                                            name="password" type="password" aria-label="Amount (to the nearest dollar)"
                                            placeholder="Password" >
                                    </div>
                                    @if ($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <input class="form-control @error('password') is-invalid @enderror"
                                            name="password_confirmation" type="password" aria-label="Amount (to the nearest dollar)"
                                            placeholder="Konfirmasi password">
                                    </div>
                                    @if ($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3 input-group-solid">
                                    <label class="form-label">Level</label>
                                    <select name="level" class="form-select form-control">
                                        <option selected disabled>Pilih Level</option>
                                        <option value="petugas">Petugas</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    @if ($errors->has('level'))
                                    <div class="text-danger">{{ $errors->first('level') }}</div>
                                    @endif
                                </div>

                                <div class="card-footer">
                                    <button class="btn btn-primary m-r-15" type="submit">Tambah</button>
                                    <a href="/admin/petugas" class="btn btn-light">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection