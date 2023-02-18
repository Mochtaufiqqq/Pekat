@extends('layouts.admin.master')

@section('title','Laporan')
    
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
              
                <h3>Laporan</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h6>Cari berdasarkan tanggal</h6>
                </div>
                <div class="card-body">
                    <form action="/admin/laporan/getreport" method="POST">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="text" name="from" placeholder="Tanggal awal" onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="to" placeholder="Tanggal akhir" onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                        </div>
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Data berdasarkan tanggal</h6>
                    <div class="text-end">
                    @if ($pengaduan ?? '')
                        <a class="btn btn-primary mr-2" href="{{ route('laporan.cetak', ['from' => $from, 'to' => $to]) }}">Export PDF</a>
                    @endif
                </div>
                </div>
                <div class="card-title">
                    
                </div>
                <div class="card-body">
                    @if ($pengaduan ?? '' )
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Pelapor</th>
                                    <th>Lokasi Kejadian</th>
                                    <th>Tanggal</th>
                                    <th>Isi Laporan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengaduan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->nik }}</td>
                                        <td>{{ $item->user->nama }}</td>
                                        <td>{{ $item->lokasi_kejadian }}</td>
                                        <td>{{ $item->tgl_pengaduan }}</td>
                                        <td>{{ $item->isi_laporan }}</td>
                                        <td>
                                            @if ($item->status == '0')
                                                <span class="badge badge-danger">Pending</span>
                                            @elseif ($item->status == 'proses')
                                                <span class="badge badge-warning">Proses</span>
                                            @else 
                                                <span class="badge badge-success">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                    <div class="text-center">
                        Tidak ada data
                    </div>    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
