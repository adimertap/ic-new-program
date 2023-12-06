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
        <a href="{{ route('admin-dashboard')}}" class="active"><i
            class="material-icons-two-tone">dashboard</i>Dashboard</a>
      </li>
      <li class="{{ request()->segment(1) == 'master' ? 'active-page' : '' }}">
        <a href=><i class="material-icons-two-tone">inbox</i>Master<i
            class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
        <ul class="sub-menu">
          <li>
            <a href="{{ route('admin-user')}}" class="{{ request()->segment(2) == 'users' ? 'active' : ''}}">Users</a>
          </li>
          <li>
            <a href="{{ route('admin-pemateri')}}"
              class="{{ request()->segment(2) == 'pemateri' ? 'active' : ''}}">Pemateri</a>
          </li>
          <li>
            <a href="{{ route('admin-produk')}}"
              class="{{ request()->segment(2) == 'produk' ? 'active' : ''}}">Produk</a>
          </li>
          <li>
            <a href="{{ route('admin-gallery')}}"
              class="{{ request()->segment(2) == 'gallery' ? 'active' : ''}}">Gallery</a>
          </li>
          <li>
            <a href="{{ route('admin-materi')}}"
              class="{{ request()->segment(2) == 'materi' ? 'active' : ''}}">Materi</a>
          </li>
          <li>
            <a href="{{ route('admin-sertifikat')}}"
              class="{{ request()->segment(2) == 'sertifikat' ? 'active' : ''}}">Sertifikat</a>
          </li>
          <li>
            <a href="{{ route('admin-instansi')}}"
              class="{{ request()->segment(2) == 'instansi' ? 'active' : ''}}">Instansi</a>
          </li>
          <li>
            <a href="{{ route('admin-master-jenis-instansi.index')}}"
              class="{{ request()->segment(2) == 'master-jenis-instansi' ? 'active' : ''}}">Jenis Instansi</a>
          </li>
          <li>
            <a href="{{ route('admin-diskon')}}"
              class="{{ request()->segment(2) == 'diskon' ? 'active' : ''}}">Diskon</a>
          </li>
          <li>
            <a href="{{ route('admin-master-pendidik.index')}}"
              class="{{ request()->segment(2) == 'master-pendidik' ? 'active' : ''}}">Tenaga Pendidik</a>
          </li>
          <li>
            <a href="{{ route('admin-master-header.index')}}"
              class="{{ request()->segment(2) == 'master-header' ? 'active' : ''}}">Header</a>
          </li>
          <li>
            <a href="{{ route('admin-meta.index')}}"
              class="{{ request()->segment(2) == 'meta' ? 'active' : ''}}">Meta Title</a>
          </li>
        </ul>
      </li>
      <li class="{{ request()->segment(1) == 'keranjang-produk' || request()->segment(1) == 'keranjang-otomatis' || request()->segment(1) == 'keranjang-lama' ? 'active-page' : '' }}">
        <a href=><i class="material-icons-two-tone">account_balance_wallet</i>Keranjang<i
            class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
        <ul class="sub-menu">
          <li>
            <a href="{{ route('admin-keranjang-produk')}}" class="{{ request()->segment(1) == 'keranjang-produk' ? 'active' : ''}}">Keranjang Manual</a>
          </li>
          <li>
            <a href="{{ route('admin-keranjang-otomatis.index')}}" class="{{ request()->segment(1) == 'keranjang-otomatis' ? 'active' : ''}}">Keranjang Otomatis</a>
          </li>
          <li>
            <a href="{{ route('admin-keranjang-lama.index')}}" class="{{ request()->segment(1) == 'keranjang-lama' ? 'active' : ''}}">Keranjang Data Lama</a>
          </li>
         
        </ul>
      </li>

     
      <li class="{{ request()->segment(1) == 'trash' ? 'active-page' : '' }}">
        <a href=><i class="material-icons-two-tone">cloud_queue</i>Trash<i
            class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
        <ul class="sub-menu">
          <li>
            <a href="{{ route('admin-trash-users')}}"
              class="{{ request()->segment(2) == 'trash-users' ? 'active' : ''}}">Users</a>
          </li>
          <li>
            <a href="{{ route('admin-trash-keranjang-produk')}}"
              class="{{ request()->segment(2) == 'trash-keranjang-produk' ? 'active' : ''}}">Keranjang
              Produk</a>
          </li>
        </ul>
      </li>
      <li class="{{ request()->segment(1) == 'ujian' ? 'active-page' : '' }}">
        <a href="todo.html"><i class="material-icons-two-tone">bookmark</i>Ujian Online<i
            class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
        <ul class="sub-menu">
          <li>
            <a href="{{ route('admin-ujian-bank-soal')}}"
              class="{{ request()->segment(2) == 'bank-soal' ? 'active' : ''}}">Bank Soal</a>
          </li>
          <li>
            <a href="{{ route('admin-ujian-akses-ujian')}}"
              class="{{ request()->segment(2) == 'akses-ujian' ? 'active' : ''}}">Akses Ujian</a>
          </li>
          <li>
            <a href="{{ route('admin-hasil-peserta')}}"
              class="{{ request()->segment(2) == 'hasil-peserta' ? 'active' : ''}}">Hasil Ujian</a>
          </li>
        </ul>
      </li>
      <li class="">
        <a href="{{ route('logut-auth')}}"><i class="material-icons-two-tone">logout</i>Logout</a>
      </li>
    </ul>
  </div>
</div>