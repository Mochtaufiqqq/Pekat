@extends('layouts.auth.master')

@section('content')

@section('title','Lupa Password')


<!-- page-wrapper Start-->
<section>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="login-card">
                    <form class="theme-form login-form" action="/password/email" method="POST">
                        @csrf
                        <h4>Lupa Password</h4>
                        <h6>Masukan email untuk mendapatkan link reset password</h6>

                        @if (Session::has('success'))
                        <div class="alert alert-success mt-2">
                            {{ Session::get('success') }}
                        </div>
                        @endif

                        @if (Session::has('error'))
                        <div class="alert alert-danger mt-2">
                            {{ Session::get('error') }}
                        </div>
                        @endif
                        
                        @if ($errors->has('error'))
                        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                        @endif

                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                <input class="form-control" type="email"
                                    name="email" placeholder="Test@gmail.com">

                            </div>
                        </div>


                        <div class="form-group">
                            <button class="btn text-white form-control" type="submit" style="background-color:#0A2647;">Kirim link reset password</button>
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