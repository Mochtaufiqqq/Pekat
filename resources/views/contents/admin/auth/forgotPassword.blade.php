@extends('layouts.auth.master')

@section('content')

@section('title','Login')


<!-- page-wrapper Start-->
<section>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="login-card">
                    <form class="theme-form login-form" action="/password/email" method="POST">
                        @csrf
                        <h4>Ubah Password</h4>
                        <h6>Selamat Datang ! Silahkan masuk dengan akun yang sudah terdaftar.</h6>

                        {{-- @if (Session::has('email'))
                            <div class="alert alert-danger mt-2">
                                {{ Session::get('email') }}
                </div>
                @endif --}}
                <div class="form-group">
                    <label>Email</label>
                    <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                        <input id="email" value="{{ old('email') }}" class="form-control" type="text" name="email"
                            required="" placeholder="Test@gmail.com">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group">
                    <button class="btn btn-primary form-control text-white" type="submit">Kirim</button>
                </div>
                {{-- <div class="login-social-title">
                                <h5>Sign in with</h5>
                            </div>
                            <div class="form-group">
                                <ul class="login-social">
                                    <li><a href="https://www.linkedin.com/login" target="_blank"><i
                                                data-feather="linkedin"></i></a></li>
                                    <li><a href="https://www.linkedin.com/login" target="_blank"><i
                                                data-feather="twitter"></i></a></li>
                                    <li><a href="https://www.linkedin.com/login" target="_blank"><i
                                                data-feather="facebook"></i></a></li>
                                    <li><a href="https://www.instagram.com/login" target="_blank"><i
                                                data-feather="instagram"> </i></a></li>
                                </ul>
                            </div> --}}
                </form>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection