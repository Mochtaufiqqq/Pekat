@extends('layouts.auth.master')

@section('content')

@section('title','Ubah Password')


<!-- page-wrapper Start-->
<section>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="login-card">
                    <form class="theme-form login-form" action="/admin/password/change" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $mytoken }}">
                        {{-- <input type="email" name="email" id="" value="{{ $email }}"> --}}

                        <h4>Ubah Password</h4>
                        <h6>Ubah password anda.</h6>

                        @if ($errors->has('password'))
                        <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                        @endif

                        {{-- <div class="form-group">
                                <label>Email</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                    <input class="form-control" type="email" name="email"
                                        placeholder="Masukan email anda" value="{{ old('email', $email) }}">
                </div>
            </div> --}}
            <div class="form-group">
                <label>Password</label>
                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                    <input class="form-control" type="password" name="password" placeholder="*********">
                 
                </div>
            </div>
            <div class="form-group">
                <label>Konfirmasi Password</label>
                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                    <input class="form-control" type="password" name="password_confirmation" placeholder="*********">

                </div>
                
            </div>
            <div class="form-group">
                <button class="btn text-white" type="submit" style="background-color:#0A2647;">Ubah</button>
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