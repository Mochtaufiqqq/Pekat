@extends('layouts.auth.master')

@section('content')
    
@section('title','Register')
    

    <section>
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-12 p-0">
                    <div class="login-card">
                        <form class="theme-form login-form" action="{{ route('pekat.register') }}" method="POST" style="width: 600px">
                            @csrf
                            <h4>Buat Akun</h4>
                            <h6>Masukkan data diri Anda untuk membuat Akun !</h6>
                            @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ (Session::get('error')->first()) }}
                              </div>
                            @endif
                            <div class="row">
                                <div class="col">
                            <div class="form-group">
                                <label>NIK</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <input class="form-control @error('nik') is-invalid @enderror" name="nik" id="inputNumber" type="number" 
                                        placeholder="NIK" value="{{ old('nik') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <div class="small-group">
                                    <div class="input-group"><span class="input-group-text"><i
                                                class="icon-user"></i></span>
                                        <input class="form-control  @error('nama') is-invalid @enderror" name="nama" type="text" 
                                            placeholder="Nama lengkap" value="{{ old('nama') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <input class="form-control @error('username') is-invalid @enderror" name="username" type="text" 
                                    placeholder="Username" value="{{ old('username') }}">
                                </div>
                                
                            </div>
                        </div>
                            <div class="col">
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group"><span class="input-group-text"><i
                                    class="icon-email"></i></span>
                                    <input class="form-control  @error('email') is-invalid @enderror" name="email" type="email" 
                                    placeholder="contoh@gmail.com" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" 
                                        placeholder="*********">
                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control  @error('confirmation') is-invalid @enderror" type="password" name="confirmation" 
                                        placeholder="*********">
                                </div>
                            </div>
                        </div>
                            <div class="form-group">
                                <button class="form-control btn text-white" type="submit" style="background-color:#0A2647;">Register</button>
                            </div>
                        </div>
                            {{-- <div class="login-social-title">                
                  <h5>signup with</h5>
                </div> --}}
                            {{-- <div class="form-group">
                  <ul class="login-social">
                    <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="linkedin"></i></a></li>
                    <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="twitter"></i></a></li>
                    <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="facebook"></i></a></li>
                    <li><a href="https://www.instagram.com/login" target="_blank"><i data-feather="instagram">                  </i></a></li>
                  </ul>
                </div> --}}
                 <p>Sudah punya akun ?<a class="ms-2" href="/login">Log In</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
    @endsection