@extends('layouts.user.master')


@section('title','Ubah Password')

@section('content')
{{-- Section Header --}}
@include('contents.user.nav')

{{-- Section Card --}}

<div class="container">

    <div class="row justify-content-between">

        <div class="col-lg-8 col-md-12 col-sm-12 col-12 col">

            <div class="menu menu-top shadow">
                <div>
                    <form action="/ubah/password/post/{{ Auth::guard('masyarakat')->user()->id }}" method="POST">
                        @csrf
                        @method('put')
                        @if (Session::has('success'))
                            
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                        @endif

                        <h4 class="mb-2">Ubah Password</h4>
                        <hr>
                        <div class="form-group">
                            <label class="label-change" for="old_password">Konfirmasi Password lama</label>
                            <input type="password" name="old_password" id="" class="form-control" placeholder="Password lama">
                            @if ($errors->has('old_password'))
                            <div class="text-danger-custom">{{ $errors->first('old_password') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="label-change" for="new_password">Masukan Password Baru</label>
                            <input type="password" name="new_password" id="" class="form-control" placeholder="Password baru">
                            @if ($errors->has('new_password'))
                            <div class="text-danger-custom">{{ $errors->first('new_password') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="label-change" for="confirmation">Konfirmasi Password</label>
                            <input type="password" name="new_password_confirmation" class="form-control" placeholder="Konfirmasi password">
                            @if ($errors->has('new_password'))
                            <div class="text-danger-custom">{{ $errors->first('new_password') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-custom" type="submit">Ubah</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <div class="col-lg-4 col-md-12 col-sm-12 col-12 col">
            <div class="menu menu-top shadow">
                <h5>Menu</h5>
                <hr>
                <a class="menu-right" href="/profile"> <i class="fa fa-user my-2"></i>
                    <small class="ml-2">Profil saya</small>
                </a>
                <hr>
                <a class="menu-right" href="/pengaduan/me"> <i class="fa fa-file my-2"></i>
                    <small class="ml-2">Laporan saya</small>
                </a>
                <hr>
                <a class="menu-right {{ $active == 'ubah/password' ? '' : 'menu-active'}}" href="/ubah/password"><i class="fa fa-lock my-2"></i>
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

@endsection

@section('js')
@if (Session::has('pesan'))
<script>
    $('#loginModal').modal('show');
</script>

@endif

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