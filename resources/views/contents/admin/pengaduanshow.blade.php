@extends('layouts.admin.master')


@section('title','Pengaduan')
    
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
              
                <h3>Pengaduan</h3>
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
                    <h5>Semua Pengaduan</h5><span>Dibawah Ini adalah table semua data user aktif dan user nonaktif kamu bisa mengelolanya. Terdapat Beberapa Button Untuk Mengelola</span>
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
                                {{-- <th scope="col">Nama Pelapor</th> --}}
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
                                        <a class="btn btn-primary mb-3" href="/admin/detailpengaduan/{{ $p->id_pengaduan }}">Detail</a>
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