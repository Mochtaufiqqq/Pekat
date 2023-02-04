@extends('layouts.admin.master')


@section('content')
    
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">

                <h3>Edit Petugas</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/semuauser">Semua User</a></li>
                    <li class="breadcrumb-item"> <a href="/useraktif"></a> User Aktif</li>
                    <li class="breadcrumb-item active"><a href="/usernonaktif"></a> User Nonaktif</li>
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
                    <h5>Edit Petugas</h5>
                 </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="/admin/updatepetugas/{{ $petugas->id_petugas }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="mb-3 m-form__group">
                                    <label class="form-label">Nama Petugas</label>
                                    <div class="input-group">
                                        <input class="form-control @error('nama_petugas') is-invalid @enderror" type="text"
                                            name="nama_petugas" value="{{ old('nama_petugas',$petugas->nama_petugas) }}" placeholder="Nama lengkap" required>
                                    </div>
                                    @error('nisn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 m-form__group">
                                    <label class="form-label">Username</label>
                                    <div class="input-group">
                                        <input class="form-control @error('username') is-invalid @enderror" type="text"
                                            name="username" value="{{ old('username',$petugas->username) }}" placeholder="Username" required>
                                    </div>
                                    @error('nisn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 m-form__group">
                                    <label class="form-label">Telp</label>
                                    <div class="input-group">
                                        <input class="form-control @error('nisn') is-invalid @enderror" type="text"
                                            name="telp" value="{{ old('telp',$petugas->telp) }}" placeholder="contoh:08909890" required>
                                    </div>
                                    @error('nisn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group">
                                        <input class="form-control @error('password') is-invalid @enderror"
                                            name="password" type="password" aria-label="Amount (to the nearest dollar)"
                                            placeholder="Password">
                                    </div>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 input-group-solid">
                                    <label class="form-label">Level</label>
                                    <select name="level" class="form-select form-control" required autofocus>
                                        @if ($petugas->level == 'admin')
                                        <option selected value="admin">Admin</option>
                                        <option value="petugas">Petugas</option>
                                        @else
                                        <option value="admin">Admin</option>
                                        <option selected value="petugas">Petugas</option>
                                        @endif
                                    </select>
                                    @error('jurusan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
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