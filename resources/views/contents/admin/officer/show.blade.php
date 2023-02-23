@extends('layouts.admin.master')


@section('title','Data Petugas')
    
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
              
                <h3>Petugas</h3>
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
                <div class="card-header pb-0">
                    <h5>Semua Petugas</h5>
                </div>
                <div class="card-body">
                  <a class="btn btn-success mb-2" href="/admin/petugas/tambah">Tambah Data</a>
                  <a class="btn btn-secondary mb-2" href="/admin/petugas/printpdf">Export PDF</a>
                    <div class="dt-ext table-responsive">
                      <table class="table table-bordered" id="basic-row-reorder">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">No telp</th>
                                <th scope="col">level</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($petugas as $p)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $p->nama_petugas }}</td>
                                    <td>{{ $p->username }}</td>
                                    <td>{{ $p->telp }}</td>
                                    <td>{{ $p->level }}</td>
                                    <td>
                                        <a class="btn mb-3" href="/admin/petugas/detail/{{ $p->id_petugas }}" style="color: white; background-color:#645CBB;">Detail</a>
                                        <a class="btn btn-warning mb-3" href="/admin/petugas/edit/{{ $p->id_petugas }}">Edit</a>
                                        <a class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $p->id_petugas }}" href="/admin/petugas/delete/{{ $p->id_petugas }}">Hapus</a>

                                         {{-- modal delete --}}
                                   <div class="modal fade" id="modalDelete{{ $p->id_petugas }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Hapus Petugas</h5>
                                          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah anda yakin menghapus {{ $p->nama_petugas }} ?</p>
                                        </div>
                                        <div class="modal-footer">
                                          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                                          <form action="/admin/petugas/delete/{{ $p->id_petugas }}" method="POST">
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