<!-- navbar start -->
<header class="absolute top-10 left-0 flex items-center w-full">
    <div class="container mx-auto px-10">
        <div class="relative flex items-center justify-between py-1">
            <img src="{{ asset('/images/ic-edu-logo.png') }}" alt="iceducation-logo" class="mx-auto md:mx-0" />
            <nav id="nav-menu" class="hidden lg:block">
                <ul class="flex flex-row space-x-10">
                    <li class="group">
                        <a href="{{ route('home-beranda') }}" class="flex py-2 group-hover:text-red uppercase">Home</a>
                        <span class="block w-10 h-0.5 group-hover:bg-red mx-auto"></span>
                    </li>
                    <li class="group">
                        <a href="{{ route('home-brevet') }}" class="flex py-2 group-hover:text-red uppercase">brevet</a>
                        <span class="block w-10 h-0.5 group-hover:bg-red mx-auto"></span>
                    </li>
                    <li class="group">
                        <a href="{{ route('home-seminar')}}" class="flex py-2 group-hover:text-red uppercase">seminar</a>
                        <span class="block w-10 h-0.5 group-hover:bg-red mx-auto"></span>
                    </li>
                    <li class="group">
                        <a href="{{ route('home-inhouse')}}" class="flex py-2 group-hover:text-red uppercase">in house training</a>
                        <span class="block w-10 h-0.5 group-hover:bg-red mx-auto"></span>
                    </li>
                    <li class="group">
                        <a href="{{ route('home-uskp')}}" class="flex py-2 group-hover:text-red uppercase">uskp review</a>
                        <span class="block w-10 h-0.5 group-hover:bg-red mx-auto"></span>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<!-- navbar selesai -->