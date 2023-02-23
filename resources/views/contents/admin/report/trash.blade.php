@extends('layouts.admin.master')


@section('title','Sampah')
    
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
              
                <h3>Sampah</h3>
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
                    <h5>Pengaduan yang telah dihapus</h5>
                </div>
                <div class="card-body">
                  {{-- <a class="btn btn-success mb-2" href="/admin/tambahpetugas">Tambah Data</a> --}}
                    <div class="dt-ext table-responsive">
                      <table class="table table-bordered" id="basic-row-reorder">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal pengaduan</th>
                                <th scope="col">NIK</th>
                                <th scope="col">Nama Pelapor</th>
                                <th scope="col">Isi Laporan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Opsi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaduan as $p)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $p->tgl_pengaduan->format('d-M-Y') }}</td>
                                    <td>{{ $p->nik }}</td>
                                    <td>{{ $p->user->nama }}</td>
                                    <td>{{ $p->isi_laporan }}</td>
                                    <td>
                                        @if ($p->status == '0')
                                            <span class="badge badge-danger">Pending</span>
                                        @elseif ($p->status == 'proses')
                                            <span class="badge badge-warning">Proses</span>
                                        @else 
                                            <span class="badge badge-success">Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="mx-auto">
                                        <a class="btn btn-secondary mb-2" href="/admin/sampah/restore/{{ $p->id_pengaduan }}" data-bs-toggle="modal" data-bs-target="#modalRestore{{ $p->id_pengaduan }}">Restore</a>
                                        <a class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#modalForce{{ $p->id_pengaduan }}" href="/admin/sampah/hapus/{{ $p->id_pengaduan }}">Hapus</a>

                                         {{-- modal restore --}}
                                         <div class="modal fade" id="modalRestore{{ $p->id_pengaduan }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Restore Pengaduan</h5>
                                                  <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin mengembalikan pengaduan ini ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                  <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                                                  <form action="/admin/sampah/restore/{{ $p->id_pengaduan }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                  <button class="btn btn-primary" type="submit">Yakin</button>
                                                </form>
                                                </div>
                                              </div>
                                            </div>
                                          </div>

                                        {{-- modal delete --}}
                                        <div class="modal fade" id="modalForce{{ $p->id_pengaduan }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Hapus Pengaduan</h5>
                                                  <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus pengaduan ini ? tindakan ini akan menghapus pengaduan secara permanen</p>
                                                </div>
                                                <div class="modal-footer">
                                                  <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                                                  <form action="/admin/sampah/hapus/{{ $p->id_pengaduan }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                  <button class="btn btn-primary" type="submit">Yakin</button>
                                                </form>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                    </div>
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