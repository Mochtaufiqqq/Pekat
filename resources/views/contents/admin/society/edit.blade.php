@extends('layouts.admin.master')

@section('title','Edit Masyarakat')

@section('content')


<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6 mb-2">

                <h3>Edit Masyarakat</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/masyarakat">Semua Masyarakat</a></li>
                </ol>

            </div>
            <div class="col-sm-12">
                @if (Session::has('pesan'))
                <div class="alert alert-danger" role="alert">
                    {{ (Session::get('pesan')) }}
                </div>
                @endif
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
                    <h5>Edit Masyarakat</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="/admin/masyarakat/update/{{ $society->nik }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="mb-3 m-form__group">
                                    <label class="form-label">NIK</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number"
                                            name="nik" value="{{ old('nik',$society->nik) }}">
                                </div>
                                <div class="mb-3 m-form__group">
                                    <label class="form-label">Nama Lengkap</label>
                                    <div class="input-group">
                                        <input class="form-control @error('nama') is-invalid @enderror" type="text"
                                            name="nama" value="{{ old('nama',$society->nama) }}" required>
                                    </div>
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 m-form__group">
                                    <label class="form-label">Username</label>
                                    <div class="input-group">
                                        <input class="form-control @error('username') is-invalid @enderror" type="text"
                                            name="username" value="{{ old('username',$society->username) }}"
                                            placeholder="Username" required>
                                    </div>
                                    @error('society')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 m-form__group">
                                    <label class="form-label">Email</label>
                                    <div class="input-group">
                                        <input class="form-control @error('email') is-invalid @enderror" type="text"
                                            name="email" value="{{ old('email',$society->email) }}"
                                            placeholder="Username">
                                    </div>
                                    @error('society')
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
                                            placeholder="Password" value="{{ old('username', $society->password) }}">
                                    </div>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="card-footer">
                                    <button class="btn btn-primary m-r-15" type="submit">Update</button>
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