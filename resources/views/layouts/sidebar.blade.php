<aside class="left-sidebar bg-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand d-flex justify-content-start align-items-center">
            <img src="{{ asset('assets/dashboard/img/logo-smk-6.png') }}" alt="logo" width="65"
                class="brand-icon ml-2">
            <a href="{{ route('home') }}" title="Sleek Dashboard">
                <span class="text-white font-weight-bold ml-0">SIMAG DASHBOARD</span>
            </a>
        </div>

        <!-- begin sidebar scrollbar -->
        <div class="" data-simplebar style="height: 100%;">
            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <li class="has-sub {{ Request::is('home') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('home') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                @role('super-admin')
                    <li class="section-title">
                        Master User
                    </li>

                    <li class="has-sub {{ Request::is('user-manage/*') ? 'active expand' : '' }}">
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#app"
                            aria-expanded="false" aria-controls="app">
                            <i class="mdi mdi-account-multiple"></i>
                            <span class="nav-text">User Manage</span> <b class="caret"></b>
                        </a>

                        <ul class="collapse {{ Request::is('user-manage/*') ? 'show' : '' }}" id="app"
                            data-parent="#sidebar-menu">
                            <div class="sub-menu">
                                <li class="{{ Request::is('user-manage/all-user') ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ route('user.all') }}">
                                        <span class="nav-text">All User</span>
                                    </a>
                                </li>

                                <li class="{{ Request::is('user-manage/siswa') ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ route('user.siswa') }}">
                                        <span class="nav-text">Siswa</span>
                                    </a>
                                </li>

                                <li class="{{ Request::is('user-manage/guru-pembimbing') ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ route('user.guru-pembimbing') }}">
                                        <span class="nav-text">Guru Pembimbing</span>
                                    </a>
                                </li>
                            </div>
                        </ul>
                    </li>

                    <li class="section-title">
                        Master Data
                    </li>

                    <li
                        class="has-sub {{ Request::is('kelas/*') || Request::is('jurusan/*') || Request::is('tahun-magang/*') || Request::is('logbook/*') ? 'active expand' : '' }}">
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                            data-target="#components" aria-expanded="false" aria-controls="components">
                            <i class="mdi mdi-database"></i>
                            <span class="nav-text">Master Data</span> <b class="caret"></b>
                        </a>

                        <ul class="collapse {{ Request::is('kelas/*') || Request::is('jurusan/*') || Request::is('tahun-magang/*') || Request::is('logbook/*') ? 'show' : '' }}"
                            id="components" data-parent="#sidebar-menu">
                            <div class="sub-menu">
                                <li class="{{ Request::is('jurusan/*') ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ route('jurusan.index') }}">
                                        <span class="nav-text">Jurusan</span>
                                    </a>
                                </li>

                                <li class="{{ Request::is('kelas/*') ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ route('kelas.index') }}">
                                        <span class="nav-text">Kelas</span>
                                    </a>
                                </li>

                                <li class="{{ Request::is('tahun-magang/*') ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ route('tahun-magang.index') }}">
                                        <span class="nav-text">Tahun Ajaran Magang</span>

                                    </a>
                                </li>

                        </ul>
                    </li>

                    <li class="section-title">
                        Master Magang
                    </li>

                    <li class="has-sub {{ Request::is('magang/*') ? 'active expand' : '' }}">
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#icons"
                            aria-expanded="false" aria-controls="icons">
                            <i class="mdi mdi-school"></i>
                            <span class="nav-text">Data Magang</span> <b class="caret"></b>
                        </a>

                        <ul class="collapse {{ Request::is('magang/*') ? 'show' : '' }}" id="icons"
                            data-parent="#sidebar-menu">
                            <div class="sub-menu">
                                <li class="{{ Request::is('magang/*') ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ route('magang.index') }}">
                                        <span class="nav-text">Data Magang</span>
                                    </a>
                                </li>

                                <li class="{{ Request::is('logbook/*') ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="#">
                                        <span class="nav-text">LogBook Magang</span>
                                    </a>
                                </li>
                            </div>
                        </ul>
                    </li>
                @endrole

                @role('siswa')
                    <li class="section-title">
                        Magang Siswa
                    </li>

                    <li class="has-sub {{ Request::is('magang/*') && !Request::is('magang/create') ? 'active' : '' }}">
                        <a class="sidenav-item-link" href="{{ route('magang.index') }}">
                            <i class="mdi mdi-school"></i>
                            <span class="nav-text">Data Magang</span>
                        </a>
                    </li>

                    <li class="has-sub {{ Request::is('magang/create') ? 'active' : '' }}">
                        <a class="sidenav-item-link" href="{{ route('magang.create') }}">
                            <i class="mdi mdi-format-list-bulleted"></i>
                            <span class="nav-text">Daftar Kegiatan</span>
                        </a>
                    </li>

                    <li class="has-sub ">
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                            data-target="#icons" aria-expanded="false" aria-controls="icons">
                            <i class="mdi mdi-school"></i>
                            <span class="nav-text">Log Book</span> <b class="caret"></b>
                        </a>

                        <ul class="collapse " id="icons" data-parent="#sidebar-menu">
                            <div class="sub-menu">
                                @foreach ($dataMagangs as $tahunMagang)
                                    <li class="">
                                        <a class="sidenav-item-link" href="{{ route('magang.index') }}">
                                            <span
                                                class="nav-text">{{ $tahunMagang->tahunAjaran->tahun_magang . ' | ' . $tahunMagang->tahunAjaran->tahun_magang }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </div>
                        </ul>
                    </li>
                @endrole

                @role('guru-pembimbing')
                    <li class="section-title">
                        Magang Pembimbing
                    </li>

                    <li class="has-sub {{ Request::is('magang/*') ? 'active' : '' }}">
                        <a class="sidenav-item-link" href="{{ route('magang.index') }}">
                            <i class="mdi mdi-school"></i>
                            <span class="nav-text">Data Magang</span>
                        </a>
                    </li>
                @endrole

            </ul>
        </div>
    </div>
</aside>
