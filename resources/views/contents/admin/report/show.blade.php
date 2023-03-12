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
                <div class="card-header pb-0">
                    <h5>Semua Pengaduan</h5>
                </div>
                <div class="card-body">
                    @if (Auth::guard('admin')->user()->level == 'admin')
                    <a href="/admin/report/printpdf" class="btn btn-secondary mb-2">Export PDF</a>
                    @endif
                  {{-- <a class="btn btn-success mb-2" href="/admin/tambahpetugas">Tambah Data</a> --}}
                    <div class="dt-ext table-responsive">
                      <table class="table table-bordered" id="basic-row-reorder">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal pengaduan</th>
                                <th scope="col">NIK</th>
                                <th scope="col">Nama Pelapor</th>
                                <th scope="col">Deskripsi Laporan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Opsi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaduan as $p)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $p->tgl_pengaduan->format('d-M-Y') }}</td>
                                    <td>{{ $p->user->nik ?? ''}}</td>
                                    <td>{{ $p->user->nama ?? '' }}</td>
                                    <td>{{ Str::limit($p->isi_laporan,50) }}</td>
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
                                        
                                        <a class="btn mb-2" style="background-color: #645CBB; color: white;" href="/admin/pengaduan/detail/{{ $p->id_pengaduan }}">Detail</a>
                                       
                                        <a class="btn btn-danger mb-2" style="background-color: #645CBB; color: white;" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $p->id_pengaduan }}" href="/admin/pengaduan/hapus/{{ $p->id_pengaduan }}">Hapus</a>
                                
                                      
                                        {{-- modal delete --}}
                                        <div class="modal fade" id="modalDelete{{ $p->id_pengaduan }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Hapus Pengaduan</h5>
                                                  <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus pengaduan dari user yang bernama {{ $p->user->nama ?? '' }} ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                  <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                                                  <form action="/admin/pengaduan/delete/{{ $p->id_pengaduan }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                  <button class="btn btn-primary" type="submit">Yakin</button>
                                                </form>
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