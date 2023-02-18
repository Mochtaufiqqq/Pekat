@extends('layouts.admin.master')


@section('title','Edit Petugas')

@section('content')



<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">

                <h3>Edit Petugas</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/petugas">Semua petugas</a></li>
                    {{-- <li class="breadcrumb-item"> <a href="/useraktif"></a> User Aktif</li>
                    <li class="breadcrumb-item active"><a href="/usernonaktif"></a> User Nonaktif</li> --}}
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
                    <h5>Edit Form</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="/admin/petugas/update/{{ $petugas->id_petugas }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="mb-3 m-form__group">
                                    <label class="form-label">Nama Petugas</label>
                                    <div class="input-group">
                                        <input class="form-control @error('nama_petugas') is-invalid @enderror"
                                            type="text" name="nama_petugas" placeholder="Nama lengkap" value="{{ $petugas->nama_petugas }}">
                                    </div>
                                    @if ($errors->has('nama_petugas'))
                                    <div class="text-danger">{{ $errors->first('nama_petugas') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3 m-form__group">
                                    <label class="form-label">Alamat</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="alamat" id="" rows="2" placeholder="Alamat" value="{{ $petugas->alamat }}">{{ $petugas->alamat }}</textarea>
                                    </div>
                                    @if ($errors->has('alamat'))
                                    <div class="text-danger">{{ $errors->first('alamat') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3 m-form__group">
                                    <label class="form-label">Email</label>
                                    <div class="input-group">
                                        <input class="form-control @error('email') is-invalid @enderror" type="email"
                                            name="email" placeholder="contoh@gmail.com" value="{{ $petugas->email }}">
                                    </div>
                                    @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3 m-form__group">
                                    <label class="form-label">Telp</label>
                                    <div class="input-group">
                                        <input class="form-control @error('telp') is-invalid @enderror" type="text"
                                            name="telp" placeholder="contoh:08909890" value="{{ $petugas->telp }}">
                                    </div>
                                    @if ($errors->has('telp'))
                                    <div class="text-danger">{{ $errors->first('telp') }}</div>
                                    @endif
                                </div>
                                
                                <div class="mb-3 input-group-solid">
                                    <label class="form-label">Level</label>
                                    <select name="level" class="form-select form-control">
                                        @if ($petugas->level == 'admin')
                                        <option selected value="admin">Admin</option>
                                        <option value="petugas">Petugas</option>
                                        @else
                                        <option value="admin">Admin</option>
                                        <option selected value="petugas">Petugas</option>
                                        @endif
                                    </select>
                                    @if ($errors->has('level'))
                                    <div class="text-danger">{{ $errors->first('level') }}</div>
                                    @endif
                                </div>

                                <div class="card-footer">
                                    <button class="btn btn-primary m-r-15" type="submit">Ubah</button>
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