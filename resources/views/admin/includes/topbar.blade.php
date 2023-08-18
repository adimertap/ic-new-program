<div class="app-header">
    <nav class="navbar navbar-light navbar-expand-lg">
        <div class="container-fluid">
            <div class="navbar-nav" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link hide-sidebar-toggle-button" href="#"><i class="material-icons">first_page</i></a>
                    </li>
                </ul>

            </div>
            <div class="d-flex">
                <ul class="navbar-nav small">
                    @if (request()->segment(1) == 'master')
                        <li class="nav-item hidden-on-mobile">
                            <a class="nav-link {{ request()->segment(2) == 'users' ? 'active' : ''}}" href="{{ route('admin-user')}}">Users</a>
                        </li>
                        <li class="nav-item hidden-on-mobile">
                            <a class="nav-link {{ request()->segment(2) == 'pemateri' ? 'active' : ''}}" href="{{ route('admin-pemateri')}}">Pemateri</a>
                        </li>
                        <li class="nav-item hidden-on-mobile">
                            <a class="nav-link {{ request()->segment(2) == 'produk' ? 'active' : ''}}" href="{{ route('admin-produk')}}">Produk</a>
                        </li>
                        <li class="nav-item hidden-on-mobile">
                            <a class="nav-link {{ request()->segment(2) == 'gallery' ? 'active' : ''}}" href="{{ route('admin-gallery')}}">Gallery</a>
                        </li>
                        <li class="nav-item hidden-on-mobile">
                            <a class="nav-link {{ request()->segment(2) == 'materi' ? 'active' : ''}}" href="{{ route('admin-materi')}}">Materi</a>
                        </li>
                        <li class="nav-item hidden-on-mobile">
                            <a class="nav-link {{ request()->segment(2) == 'sertifikat' ? 'active' : ''}}" href="{{ route('admin-sertifikat')}}">Sertifikat</a>
                        </li>
                        <li class="nav-item hidden-on-mobile">
                            <a class="nav-link {{ request()->segment(2) == 'instansi' ? 'active' : ''}}" href="{{ route('admin-instansi')}}">Instansi</a>
                        </li>
                        <li class="nav-item hidden-on-mobile">
                            <a class="nav-link {{ request()->segment(2) == 'master-jenis-instansi' ? 'active' : ''}}" href="{{ route('admin-master-jenis-instansi.index')}}">Jenis Instansi</a>
                        </li>
                        <li class="nav-item hidden-on-mobile">
                            <a class="nav-link {{ request()->segment(2) == 'diskon' ? 'active' : ''}}" href="{{ route('admin-diskon')}}">Diskon</a>
                        </li>
                        <li class="nav-item hidden-on-mobile">
                            <a class="nav-link {{ request()->segment(2) == 'master-header' ? 'active' : ''}}" href="{{ route('admin-master-header.index')}}">Header</a>
                        </li>
                        <li class="nav-item hidden-on-mobile">
                            <a class="nav-link {{ request()->segment(2) == 'master-pendidik' ? 'active' : ''}}" href="{{ route('admin-master-pendidik.index')}}">Teams</a>
                        </li>
                    @elseif (request()->segment(1) == 'trash')
                        <li class="nav-item hidden-on-mobile">
                            <a class="nav-link {{ request()->segment(2) == 'trash-users' ? 'active' : ''}}" href="{{ route('admin-trash-users')}}">Users</a>
                        </li>
                        <li class="nav-item hidden-on-mobile">
                            <a class="nav-link {{ request()->segment(2) == 'trash-keranjang-produk' ? 'active' : ''}}" href="{{ route('admin-trash-keranjang-produk')}}">Keranjang Produk</a>
                        </li>
                    @elseif (request()->segment(1) == 'ujian')
                        <li class="nav-item hidden-on-mobile">
                            <a class="nav-link {{ request()->segment(2) == 'bank-soal' ? 'active' : ''}}" href="{{ route('admin-ujian-bank-soal')}}">Bank Soal</a>
                        </li>
                        <li class="nav-item hidden-on-mobile">
                            <a class="nav-link {{ request()->segment(2) == 'akses-ujian' ? 'active' : ''}}" href="{{ route('admin-ujian-akses-ujian')}}">Akses Ujian</a>
                        </li>
                    @endif
                    <li class="nav-item hidden-on-mobile">
                        <a class="nav-link" href="{{ route('logut-auth')}}">
                            <i class="material-icons">
                                logout
                            </i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>