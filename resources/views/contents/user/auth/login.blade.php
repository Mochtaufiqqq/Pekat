
@extends('layouts.auth.master')

@section('content')

@section('title','Login')
    
    
    <!-- page-wrapper Start-->
    <section>
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="login-card">
                        <form class="theme-form login-form" action="{{ route('pekat.login') }}" method="POST">
                            @csrf
                            <h4>Login</h4>
                            <h6>Selamat Datang ! Silahkan masuk dengan akun yang sudah terdaftar.</h6>
                           
                            @if (Session::has('pesan'))
                            <div class="alert alert-danger mt-2">
                                {{ Session::get('pesan') }}
                            </div>
                            @endif
                            @if (Session::has('success'))
                            <div class="alert alert-success mt-2">
                                {{ Session::get('success') }}
                            </div>
                            @endif
                            
                            <div class="form-group">
                                <label>Username / Email</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <input class="form-control" type="text" name="username" required=""
                                        placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control" type="password" name="password" required=""
                                        placeholder="*********">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <input id="checkbox1" type="checkbox">
                                    <label for="checkbox1">Ingatkan password</label>
                                </div>
                                <a class="link" href="/password/reset">Lupa password?</a>
                            </div>
                            <div class="form-group">
                                <button class="form-control btn text-white" type="submit" style="background-color:#0A2647;">Log in</button>
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
                            <p>Belum punya akun ?<a class="ms-2" href="{{ route('pekat.formRegister') }}">Register</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection