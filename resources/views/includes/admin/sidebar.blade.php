<header class="main-nav">
    <div class="sidebar-user text-center"><a class="setting-primary" href="/"><i
                data-feather="settings"></i></a><img class="img-90 rounded-circle" src="/admins/images/dashboard/1.png"
            alt="">
        <div class="badge-bottom"><span class="badge badge-primary">{{ Auth::guard('admin')->user()->level }}</span></div><a href="user-profile.html">
            <h6 class="mt-3 f-14 f-w-600">{{ Auth::guard('admin')->user()->nama_petugas }}</h6>
        </a>
        <p class="mb-0 font-roboto">{{ Auth::guard('admin')->user()->username }}</p>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true">
                            </i>
                        </div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Umum</h6>
                        </div>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title link-nav" href="/admin/dashboard"><i
                                data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title link-nav" href="/admin/pengaduan"><i
                                data-feather="edit"></i><span>Pengaduan</span></a>
                    </li>
                    @if (Auth::guard('admin')->user()->level == 'admin')
                    <li class="dropdown"><a class="nav-link menu-title link-nav" href="/admin/petugas"><i
                                data-feather="user"></i><span>Petugas</span></a>
                    </li>
                    @endif
                    @if (Auth::guard('admin')->user()->level == 'admin')
                    <li class="dropdown"><a class="nav-link menu-title link-nav" href="/admin/masyarakat"><i
                                data-feather="users"></i><span>Masyarakat</span></a>
                    </li>
                    @elseif (Auth::guard('admin')->user()->level == 'petugas')
                    <li class="dropdown"><a class="nav-link menu-title link-nav" href="/admin/masyarakat"><i
                                data-feather="users"></i><span>Masyarakat</span></a>
                    </li>
                    @endif
                    <li class="dropdown"><a class="nav-link menu-title link-nav" href="/admin/laporan"><i
                                data-feather="file-text"></i><span>Laporan</span></a>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title link-nav" href="/admin/sampah"><i
                        data-feather="trash"></i><span>Sampah</span></a>
                     </li>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>