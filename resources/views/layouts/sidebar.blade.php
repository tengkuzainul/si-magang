<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">SISMA SMK 6 PEKANBARU</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">SISMA</a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class=" {{ Request::is('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
            </li>

            @role('super-admin')
                <li class="menu-header">Master Users</li>
                <li class="dropdown {{ Request::is('user-manage/*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i>
                        <span>User Management</span></a>

                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('user-manage/all-user') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('user.all') }}">All Users</a></li>

                        <li class="{{ Request::is('user-manage/siswa') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('user.siswa') }}">Siswa Users</a></li>

                        <li class="{{ Request::is('user-manage/guru-pembimbing') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('user.guru-pembimbing') }}">Guru Users</a></li>
                    </ul>
                </li>

                <li class="menu-header">Master Data</li>
                <li class="{{ Request::is('jurusan/*') ? 'active' : '' }}">
                    <a href="{{ route('jurusan.index') }}" class="nav-link"><i
                            class="fas fa-stream"></i><span>Jurusan</span></a>
                </li>

                <li class="{{ Request::is('kelas/*') ? 'active' : '' }}">
                    <a href="{{ route('kelas.index') }}" class="nav-link"><i
                            class="fas fa-school"></i><span>Kelas</span></a>
                </li>

                <li class="{{ Request::is('tahun-magang/*') ? 'active' : '' }}">
                    <a href="{{ route('tahun-magang.index') }}" class="nav-link"><i class="fas fa-calendar"></i><span>Tahun
                            Magang</span></a>
                </li>

                <li class="menu-header">Master Magang</li>
                <li class=" {{ Request::is('magang/*') ? 'active' : '' }}">
                    <a href="{{ route('magang.index') }}" class="nav-link"><i class="fas fa-graduation-cap"></i><span>Data
                            Magang</span></a>
                </li>
            @endrole

            @role('guru-pembimbing')
                <li class="menu-header">Data Magang</li>
                <li class=" {{ Request::is('magang/*') ? 'active' : '' }}">
                    <a href="{{ route('magang.index') }}" class="nav-link"><i class="fas fa-graduation-cap"></i><span>Data
                            Magang & Logbook</span></a>
                </li>
            @endrole

            @role('siswa')
                <li class="menu-header">Data Magang</li>
                <li class=" {{ Request::is('magang/create') ? 'active' : '' }}">
                    <a href="{{ route('magang.create') }}" class="nav-link"><i
                            class="fas fa-graduation-cap"></i><span>Daftar Kegiatan Magang</span></a>
                </li>

                <li class=" {{ Request::is('magang/index') || Request::is('magang/tambah-logbook/*') ? 'active' : '' }}">
                    <a href="{{ route('magang.index') }}" class="nav-link"><i class="fas fa-graduation-cap"></i><span>Data
                            Magang & Logbook</span></a>
                </li>
            @endrole
        </ul>
    </aside>
</div>
