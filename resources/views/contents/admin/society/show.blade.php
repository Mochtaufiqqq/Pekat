@extends('layouts.admin.master')


@section('title','Masyarakat')
    
@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            @if (session('success'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert"><strong>Selamat ! </strong>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
                {{ session('success') }}
              </div>
              @endif
            <div class="col-sm-6">
              
                <h3>Masyarakat</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Masyarakat</h5>
                </div>
                <div class="card-body mb-4">
                  {{-- <a class="btn btn-success mb-2" href="/admin/masyarakat/tambah">Tambah Data</a> --}}
                    <div class="dt-ext table-responsive">
                      <table class="table table-bordered" id="basic-row-reorder">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">NIK</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($society as $s)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $s->nik }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->username }}</td>
                                    <td>{{ $s->email }}</td>
                                    <td>
                                        <a class="btn mb-3" style="background-color: #645CBB; color: white;" href="/admin/masyarakat/detail/{{ $s->nik }}">Detail</a>
                                        <a class="btn btn-warning mb-3" href="/admin/masyarakat/edit/{{ $s->nik }}">Edit</a>
                                        <a class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $s->nik }}" href="/admin/masyarakat/delete/{{ $s->nik }}">Hapus</a>

                                         {{-- modal delete --}}
                                   <div class="modal fade" id="modalDelete{{ $s->nik }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Hapus Masyarakat</h5>
                                          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah anda yakin menghapus {{ $s->nama }} ?</p>
                                        </div>
                                        <div class="modal-footer">
                                          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                                          <form action="/admin/deletepetugas/{{ $s->nik }}" method="POST">
                                            @csrf
                                            @method('delete')
                                          <button class="btn btn-primary" type="submit">Yakin</button>
                                        </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                    </td>
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection