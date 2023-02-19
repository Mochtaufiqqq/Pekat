@extends('layouts.admin.master')

@section('title','Dashboard')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                @if (Auth::guard('admin')->user()->level == 'admin')
                <h3>Selamat Datang Admin</h3>

                @endif
            </div>

        </div>
    </div>
</div>

<div class="container-fluid general-widget">
    <div class="row">
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden border-0">
                <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="users"></i></div>
                        <div class="media-body"><span class="m-0">Masyarakat</span>
                            <h4 class="mb-0 counter">6659</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden border-0">
                <div class="bg-secondary b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="clipboard"></i></div>
                        <div class="media-body"><span class="m-0">Pengaduan</span>
                            <h4 class="mb-0 counter">9856</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden border-0">
                <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="edit"></i></div>
                        <div class="media-body"><span class="m-0">Tanggapan</span>
                            <h4 class="mb-0 counter">893</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden border-0">
                <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="user"></i></div>
                        <div class="media-body"><span class="m-0">Petugas</span>
                            <h4 class="mb-0 counter">4531</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden border-0">
                <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="trash"></i></div>
                        <div class="media-body"><span class="m-0">Sampah</span>
                            <h4 class="mb-0 counter">4531</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>


@endsection