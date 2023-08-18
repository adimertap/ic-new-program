<div class="app-sidebar">
    <div class="logo">
        <a href="index.html" class="logo-icon"><span class="logo-text">Education</span></a>
        <span class="user-info-text">{{ Auth::user()->name }}<br><span class="user-state-info">IC -
                Education</span></span>
    </div>
    <div class="app-menu">
        <ul class="accordion-menu">
            <li class="sidebar-title">
                Menu
            </li>
            <li class="{{ request()->segment(1) == 'admin' ? 'active-page' : '' }}">
                <a href="{{ route('pemateri-dashboard')}}" class="active"><i
                        class="material-icons-two-tone">dashboard</i>Dashboard</a>
            </li>
            <li class="{{ request()->segment(1) == 'ujian' ? 'active-page' : '' }}">
                <a href=""><i class="material-icons-two-tone">bookmark</i>Ujian Online<i
                        class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('pemateri-bank-soal')}}"
                            class="{{ request()->segment(2) == 'bank-soal' ? 'active' : ''}}">Bank Soal</a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="{{ route('logut-auth')}}"><i
                        class="material-icons-two-tone">logout</i>Logout</a>
            </li>
        </ul>
    </div>
</div>