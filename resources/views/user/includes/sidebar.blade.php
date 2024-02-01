<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
    <section class="logo" style="margin-bottom: 30px">
        <a class="
        sidebar-brand
        d-flex
        align-items-center
        justify-content-center
        " href="{{ route('user-dashboard')}}">
            <div class="sidebar-brand-icon">
                <img src="{{ asset('/userAdmin/img/ic-bulet.png')}}" alt="" height="40" />
            </div>
            <div class="sidebar-brand-text mx-3">ICEDUCATION</div>
        </a>
        <hr class="sidebar-divider my-0" style="background-color: black" />

    </section>
    {{-- <section class="content" style="margin-top: 30px"> --}}
        <!-- Divider -->

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user-dashboard')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('hasil-ujian')}}">
                <i class="fas fa-fw fa-book"></i>
                <span>Hasil Ujian</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" style="background-color: black" />

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('transaksi')}}">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span>Transaksi</span>
            </a>
        </li>

        @if ($cekBrevet)

        <li class="nav-item">
            <a class="nav-link" href="{{ route('list')}}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Ujian Online</span>
            </a>
        </li>

        @endif

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" style="background-color: black" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline mt-4">
            <button class="rounded-circle border-0 bg-primary" id="sidebarToggle"></button>
        </div>

        <!-- Sidebar Message -->
        <div class="sidebar-card d-none d-lg-flex mt-4 bg-primary" >
            <p class="nav-text my-2">
                GP Plaza, Unit R3<br />
                Ground Floor Jl. Gelora II No. 01<br />
                Jakarta - Pusat
            </p>
        </div>
    {{-- </section> --}}



</ul>
