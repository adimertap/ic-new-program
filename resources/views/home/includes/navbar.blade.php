<header class="absolute top-10 left-0 flex items-center w-full head-nav-padding">
    <div class="container mx-auto px-10">
        <div class="relative flex items-center justify-between py-1">
            <img src="{{ asset('/public/images/ic-edu-logo.png')}}" alt="iceducation-logo" id="imageNav" class="" />
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
                        @else
                        <button class="btn btn-masuk" tabindex="0"
                            onclick="location.href='{{ route('login') }}'">Masuk</button>
                        @endauth

                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <button id="mobileMenuButton" class="lg:hidden pe-4" onclick="toggleMobileMenu()">
        <i class="fa-solid fa-bars fa-lg" style="color: #ffffff;"></i>
    </button>
</header>

<div id="mobileMenuCard" class="lg:hidden card">
    <div class="d-flex justify-content-between ps-3 pe-3">
        <p class="mt-2">PILIH MENU ATAU LOGIN AKUN</p>
        <button id="closeButtonMobile" class="lg:hidden" onclick="closeButtonMobile()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="h-6 w-6 text-black">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <hr>
    <nav>
        <div class="dropdown-item mb-2 p-2 ps-3">
            <a href="{{ route('home-beranda') }}" class="btn btn-sm small p-0 btn-mobile-nav"
                type="button">Home</a>
        </div>
        <div class="dropdown-item mb-2 p-2 ps-3">
            <a href="{{ route('home-brevet') }}" class="btn btn-sm small p-0 btn-mobile-nav"
                type="button">Brevet
                AB/C</a>
        </div>
        <div class="dropdown-item mb-2 p-2 ps-3">
            <a href="{{ route('home-seminar') }}" class="btn btn-sm small p-0 btn-mobile-nav"
                type="button">Seminar
                Pajak</a>
        </div>
        <div class="dropdown-item mb-2 p-2 ps-3">
            <a href="{{ route('home-inhouse') }}" class="btn btn-sm small p-0 btn-mobile-nav"
                type="button">In
                House Training</a>
        </div>
        <div class="dropdown-item mb-2 p-2 ps-3">
            <a href="{{ route('home-uskp') }}" class="btn btn-sm small p-0 btn-mobile-nav"
                type="button">USKP
                Review</a>
        </div>
        <div class="dropdown-item mb-2 p-2 ps-3">
            <a href="{{ route('home-galeri')}}" class="btn btn-sm small p-0 btn-mobile-nav" 
                type="button">Gallery</a>
        </div>
        <div class="dropdown-item mb-2 p-2 ps-3">
            <a href="{{ route('home-teams')}}" class="btn btn-sm small p-0 btn-mobile-nav" 
                type="button">Teams</a>
        </div>
        @auth
        <div class="dropdown-item mb-2 p-2 ps-3">
            <a href="{{ route('dashboard-check')}}" class="btn btn-sm small p-0 btn-mobile-nav" 
                type="button">My Dashboard</a>
        </div>
        @endauth
        <hr>
        @auth
        <div class="dropdown-item mb-2 p-2 ps-3">
            <p class="small">{{ Auth::user()->name }}</p>
        </div>
        <div class="dropdown-item mb-2 p-2 ps-3">
            <a href="{{ route('logut-auth')}}" class="btn btn-sm small p-0 btn-mobile-nav" 
                type="button">Logout</a>
        </div>
        @else
        <div class="dropdown-item mb-2 p-2 ps-3">
            <a href="{{ route('login')}}" class="btn btn-sm small p-0 btn-mobile-nav" 
                type="button">Masuk</a>
        </div>
        @endauth
        <hr>
        <p class="text-center small text-muted mt-5">IC EDUCATION</p>
    </nav>
</div>

<script>
    function toggleDropdown(event) {
        event.preventDefault();
        const dropdownMenu = event.currentTarget.nextElementSibling;
        dropdownMenu.classList.toggle("show");
    }

    function toggleMobileMenu() {
        const mobileMenuCard = document.getElementById("mobileMenuCard");
        mobileMenuCard.classList.toggle("show");
    }

    function closeButtonMobile() {
        const mobileMenuCard = document.getElementById("mobileMenuCard");
        mobileMenuCard.classList.remove("show");
    }

</script>
<!-- navbar selesai -->
