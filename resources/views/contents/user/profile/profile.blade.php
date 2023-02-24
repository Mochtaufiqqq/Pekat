@extends('layouts.user.master')


@section('title','Profil Saya')

@section('content')
{{-- Section Header --}}
@include('contents.user.nav')

{{-- Section Card --}}

<div class="container">

    <div class="row justify-content-between">

        <div class="col-lg-8 col-md-12 col-sm-12 col-12 col">

            <div class="menu menu-top shadow">
                <div>
                    <h5 class="mb-2">Profile saya</h5>

                    <hr>
                    @if (Auth::guard('masyarakat')->user()->foto_ktp = '' &&
                    Auth::guard('masyarakat')->user()->tgl_lahir == '' && Auth::guard('masyarakat')->user()->alamat ==
                    '' && Auth::guard('masyarakat')->user()->telp == '')


                    <div class="alert alert-danger">Lengkapi profil anda agar laporan cepat dikonfirmasi</div>
                    @else
                    @endif
                    {{-- <i class="fa fa-camera"></i> --}}
                    <img src="{{ asset('images/user_default.svg') }}" alt="user profile" class="photo">


                    <div class="self-align">
                        <h5><a style="color: #6a70fc; text-decoration: none;"
                                href="/profile">{{ Auth::guard('masyarakat')->user()->nama }}</a>
                            @if ($photo == '' || Auth::guard('masyarakat')->user()->tgl_lahir == '' ||
                            Auth::guard('masyarakat')->user()->alamat == '' || Auth::guard('masyarakat')->user()->telp
                            == '')
                            <img class="circle ml-0" src="/images/unverified.png" width="17" data-toggle="tooltip"
                                data-placement="top" title="Akun Belum verifikasi">
                            @else
                            <img class="circle ml-0" src="/images/verified.png" width="17" data-toggle="tooltip"
                                data-placement="top" title="Akun Terverifikasi">
                            @endif
                        </h5>

                        <p class="text-dark">{{ Auth::guard('masyarakat')->user()->username }}</p>

                    </div>
                </div>
                <div class="mt-5">
                    <a class="d-inline tab" id="tab1" onclick="showForm('form1')">
                        Informasi Publik
                    </a>
                    <a class="d-inline tab" id="tab2" onclick="showForm('form2')">
                        Informasi Pribadi
                    </a>
                    <hr>
                </div>
                <div class="mt-2 mb-4">
                    <small>Bagian <small style="color: red"> (*) </small>Dibutuhkan</small>
                </div>
                <div class="form mb-2" id="content1">
                    <form action="/update/publik/{{ Auth::guard('masyarakat')->user()->nik }}" id="form1"
                        style="display: block" method="POST">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <small class="text-muted">Username <small style="color: red"> (*) </small></small>
                            <input class="form-control" type="text" placeholder="username"
                                value="{{ Auth::guard('masyarakat')->user()->username }}" name="username">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>
                        <div class="form-group">
                            <small class="text-muted">Nama lengkap <small style="color: red"> (*) </small></small>
                            <input class="form-control" type="text" placeholder="asasd"
                                value="{{ Auth::guard('masyarakat')->user()->nama }}" name="nama">
                        </div>
                        <div class="form-group">
                            <small class="text-muted">Email <small style="color: red"> (*) </small></small>
                            <input class="form-control" type="email" placeholder="asasd"
                                value="{{ Auth::guard('masyarakat')->user()->email }}" name="email">
                        </div>

                        {{-- <div class="form-check">
                            <div class="row text-center mb-3">
                                <div class="col-6">
                                    <input type="radio" id="flexRadioDefault1">
                                    <label class="form-check-label" for="exampleCheck1">Laki laki</label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" id="flexRadioDefault2">
                                    <label class="form-check-label" for="exampleCheck1">Perempuan</label>
                                </div>
                            </div>
                        </div> --}}
                        <div class="mt-2">
                            <button type="submit" class="btn btn-custom mt-2">Update</button>
                        </div>
                    </form>
                </div>
                <div class="form mb-2" id="content2">
                    <form action="/update/{{ Auth::guard('masyarakat')->user()->nik }}" method="POST" id="form2"
                        style="display: none;" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        {{-- <div class="form-group">
                            <small class="text-muted">NIK <small style="color: red"> (*) </small></small>
                            <input class="form-control" type="number" id="inputNumber" name="nik" placeholder="No Telp"
                                value="{{ Auth::guard('masyarakat')->user()->nik }}">
                </div> --}}
                <div class="form-group">
                    <small class="text-muted">No Handphone <small style="color: red"> (*) </small></small>
                    <input class="form-control" type="number" id="inputNumber" name="telp" placeholder="No Telp"
                        value="{{ Auth::guard('masyarakat')->user()->telp }}">
                </div>
                <div class="form-group">
                    <small class="text-muted">Tanggal Lahir <small style="color: red"> (*) </small></small>
                    <input class="form-control" name="tgl_lahir"
                        value="{{ Auth::guard('masyarakat')->user()->tgl_lahir }}" type="date" placeholder="asasd">
                </div>
                <div class="form-group">
                    <small class="text-muted">Alamat <small style="color: red"> (*) </small></small>
                    <textarea class="form-control" name="alamat" value="{{ Auth::guard('masyarakat')->user()->alamat }}"
                        id="" rows="2">{{ Auth::guard('masyarakat')->user()->alamat }}</textarea>
                </div>


                <div class="form-group">
                    <small class="text-muted">Foto KTP <small style="color: red"> (*) </small></small>
                    @if ($photo)

                    <img src="{{ asset($photo) }}" class="img-preview img-fluid mb-2 col-sm-5 d-block gambar-lampiran"
                        data-toggle="modal" data-target="#imageModal" data-src="{{ asset($photo) }}">
                    @else
                    <img class="img-preview img-fluid mb-2 col-sm-5">
                    @endif
                    <img class="img-preview img-fluid mb-2">

                    <input type="file" name="foto_ktp" id="image" onchange="previewImage()"
                        value="{{ Auth::guard('masyarakat')->user()->foto_ktp }}">
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-custom mt-2">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 col-12 col">
        <div class="menu menu-top shadow">
            <h5>Menu</h5>
            <hr>
            <a class="menu-right {{ $siapa == 'profile' ? '' : 'menu-active'}}" href="/profile"> <i
                    class="fa fa-user my-2"></i>
                <small class="ml-2">Profil saya</small>
            </a>
            <hr>
            <a class="menu-right" href="/pengaduan/me"> <i class="fa fa-file my-2"></i>
                <small class="ml-2">Laporan saya</small>
            </a>
            <hr>
            <a class="menu-right" href="/ubah/password"><i class="fa fa-lock my-2"></i>
                <small class="ml-2">Ubah Password</small>
            </a>
            <hr>
            <a class="menu-right" href="/logout"> <i class="fa fa-sign-out my-2"></i>
                <small class="ml-2">Logout</small>
            </a>
        </div>
    </div>
</div>

</div>

<!-- Modal image -->

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-ctn">
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="" style="width: 100%; height: auto;">
            </div>
        </div>
    </div>
</div>

{{-- end modal image --}}

@endsection

@section('js')


@if(session()->has('success'))
    <script>
        $(document).ready(function(){
            $.toast({
                heading: 'Success',
                text: '{{ session()->get('success') }}',
                position: 'top-right',
                loaderBg:'#fff',
                icon: 'success',
                hideAfter: 3500,
                stack: 6
            });
        });
    </script>
@endif

@endsection