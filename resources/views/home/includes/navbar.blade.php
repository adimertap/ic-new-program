<!-- navbar start -->
<header class="absolute top-10 left-0 flex items-center w-full" style="padding-left: 100px;padding-right:100px">
    <div class="container mx-auto px-10">
        <div class="relative flex items-center justify-between py-1">
            <img src="{{ asset('images/ic-edu-logo.png')}}" alt="iceducation-logo" class="" width="190" />
            <nav id="nav-menu" class="hidden lg:block">
                <ul class="flex flex-row space-x-9 justify-center items-center">
                    <li class="group">
                        <a href="{{ route('home-beranda') }}"
                            class="nav-href {{ request()->segment(1) == '' ? 'text-cyan' : ''}}">Home</a>
                    </li>
                    <li class="group">
                        <div class="nav-item dropdown">

                            <a class="nav-link {{ request()->segment(1) == 'produk' ? 'text-cyan' : ''}}"
                                id="navbarDropdownUser" role="button" href="#" onclick="toggleDropdown(event)">
                                Kelas
                                <i class="fa-solid fa-chevron-down ms-2"></i>

                            </a>
                            <div class="dropdown-menu py-0" aria-labelledby="navbarDropdownUser" data-bs-popper="none">
                                <div class="rounded-3 p-2 py-3">
                                    <div class="dropdown-item">
                                        <a href="{{ route('home-brevet') }}" class="btn btn-sm small p-0 changeBtn "
                                            type="button"
                                            style="font-size:.875rem!important;color:black!important;font-weight:400!important">Brevet
                                            AB/C</a>
                                    </div>
                                    <div class="dropdown-item">
                                        <a href="{{ route('home-seminar') }}" class="btn btn-sm small p-0 changeBtn"
                                            type="button"
                                            style="font-size:.875rem!important;color:black!important;font-weight:400!important">Seminar
                                            Pajak</a>
                                    </div>
                                    <div class="dropdown-item">
                                        <a href="{{ route('home-inhouse') }}" class="btn btn-sm small p-0 changeBtn"
                                            type="button"
                                            style="font-size:.875rem!important;color:black!important;font-weight:400!important">In
                                            House Training</a>
                                    </div>
                                    <div class="dropdown-item">
                                        <a href="{{ route('home-uskp') }}" class="btn btn-sm small p-0 changeBtn"
                                            type="button"
                                            style="font-size:.875rem!important;color:black!important;font-weight:400!important">USKP
                                            Review</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="group">
                        <a href="{{ route('home-galeri')}}"
                            class="nav-href {{ request()->segment(1) == 'galeri' ? 'active' : ''}}">Gallery</a>
                    </li>

                    <li class="group">
                        <a href="{{ route('home-teams')}}"
                            class="nav-href {{ request()->segment(1) == 'teams' ? 'active' : ''}}">Teams</a>
                    </li>
                    @auth
                    <li class="group">
                        <a href="{{ route('dashboard-check')}}" class="nav-href">My Dashboard</a>
                    </li>
                    @endauth
                    <li class="group" style="margin-left: 60px;">
                        @auth
                        <div class="nav-item dropdown">
                            <a class="nav-link" id="navbarDropdownUser2" role="button" href="#"
                                onclick="toggleDropdown(event)">
                                Hi, <b>{{ Auth::user()->name }}</b>
                                <i class="dropdown-caret"></i>
                            </a>
                            <div class="dropdown-menu py-0" aria-labelledby="navbarDropdownUser2" data-bs-popper="none">
                                <div class="rounded-3 p-2 py-3">
                                    <div class="dropdown-item">
                                        <a href="{{ route('user-dashboard') }}" class="btn btn-sm small p-0 changeBtn "
                                            type="button"
                                            style="font-size:.875rem!important;color:black!important;font-weight:400!important">My
                                            Dashboard</a>
                                    </div>
                                    <div class="dropdown-item">
                                        <a href="{{ route('logut-auth') }}" class="btn btn-sm small p-0 changeBtn "
                                            type="button"
                                            style="font-size:.875rem!important;color:black!important;font-weight:400!important">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <p class="mt-3 text-white">Hi, {{ Auth::user()->name }}</p> --}}
                        @else
                        <button class="btn btn-masuk" tabindex="0"
                            onclick="location.href='{{ route('login') }}'">Masuk</button>
                        @endauth


                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<script>
    function toggleDropdown(event) {
        event.preventDefault();
        const dropdownMenu = event.currentTarget.nextElementSibling;
        dropdownMenu.classList.toggle("show");
    }

</script>
<!-- navbar selesai -->
