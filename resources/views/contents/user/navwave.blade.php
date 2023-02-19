<section class="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <h4 class="semi-bold mb-0 text-white">LAPEKAT</h4>
                    {{-- <p class="italic mt-0 text-white">Pengaduan Masyarakat</p> --}}

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    @if(Auth::guard('masyarakat')->check())

                    <ul class="navbar-nav text-center ml-auto">
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="/dashboard">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link ml-4 dropdown-toggle text-white" href="/profile" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              {{ Auth::guard('masyarakat')->user()->nama }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="/profile">Profil Saya</a>
                              <a class="dropdown-item" href="/pengaduan/me">Laporan Saya</a>
                              {{-- <a class="dropdown-item" href="#">Ubah Password</a> --}}
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="/logout">Keluar</a>
                            </div>
                          </li>
                    </ul>
                    @else
                    <ul class="navbar-nav text-center ml-auto">
                        {{-- <li class="nav-item">
                            <button class="btn text-white" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#loginModal">Tentang kami</button>
                        </li> --}}
                        <li class="nav-item">
                            <button class="btn text-white" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#loginModal">Hubungi kami</button>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link ml-2 dropdown-toggle text-white" href="/profile" id="navbarDropdown"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Masuk
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/login">Masuk sebagai masyarakat</a>
                                <a class="dropdown-item" href="/admin/login">Masuk sebagai admin</a>
                                {{-- <a class="dropdown-item" href="#">Ubah Password</a> --}}

                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pekat.formRegister') }}" class="btn btn-outline-purple">Daftar</a>
                        </li>
                    </ul>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="text-center mb">
        <h2 class="medium text-white mt-5">Layanan Pengaduan Masyarakat</h2>
        <p class="italic text-white mb-5">Sampaikan laporan anda langsung kepada instansi pemerintah</p>
    </div>
    
    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div>

</section>