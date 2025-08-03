<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        {{-- ? Logo Header --}}
        <x-layouts.dashboard.logo-header />
        {{-- ? End Logo Header --}}
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                {{-- ? dashboard --}}
                <li @class([
                    'nav-item',
                    'active' => request()->routeIs('dashboard')
                ])>
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashobard</p>
                    </a>
                </li>

                <li class="nav-section">
                    <h4 class="text-section">Menu</h4>
                </li>

                {{-- ? petugas --}}
                <li @class([
                    'nav-item',
                    'active' => request()->routeIs('dashboard.petugas.*')
                ])>
                    <a href="{{ route('dashboard.petugas.index') }}">
                        <i class="fas fa-users"></i>
                        <p>Petugas</p>
                    </a>
                </li>

                {{-- ? Pemohon --}}
                <li @class([
                    'nav-item',
                    'active' => request()->routeIs('dashboard.pemohon.*')
                ])>
                    <a href="{{ route('dashboard.pemohon.index') }}">
                        <i class="fas fa-user-friends"></i>
                        <p>Pemohon</p>
                    </a>
                </li>
                {{-- ? arsip --}}
                <li @class([
                    'nav-item',
                    'active' => request()->routeIs('dashboard.arsip.*')
                ])>
                    <a href="{{ route('dashboard.arsip.index') }}">
                        <i class="far fa-newspaper"></i>
                        <p>Arsip</p>
                    </a>
                </li>
                {{-- ? log aktifitas --}}
                <li @class([
                    'nav-item',
                    // 'active' => request()->routeIs('dashboard.pengaturan-aplikasi.index')
                ])>
                    <a href="">
                        <i class="fas fa-cogs"></i>
                        <p>Log Aktifitas</p>
                    </a>
                </li>

                {{-- ? galeri foto --}}
                    {{-- <li @class([
                        'nav-item',
                        'active' => request()->routeIs('dashboard.galery-foto.index')
                    ])>
                        <a href="{{ route('dashboard.galery-foto.index') }}">
                        <i class="fas fa-th-list"></i>
                        <p>Galeri Foto</p>
                    </a>
                </li> --}}

                {{-- ? manajement berita --}}
                {{-- <x-dashboard.linkMenu-dropdown
                    id="manajement-berita"
                    title="Manajement Berita"
                    :routes="[
                        'dashboard.kategory.index',
                        'dashboard.kategory.create',
                        'dashboard.kategory.edit',
                        'dashboard.berita.index',
                        'dashboard.berita.create',
                        'dashboard.berita.edit',
                    ]"
                    :items="[
                        [
                            'label' => 'Kategory',
                            'route' => 'dashboard.kategory.index',
                            'routes' => [
                                'dashboard.kategory.index',
                                'dashboard.kategory.create',
                                'dashboard.kategory.edit'
                            ]
                        ],
                        [
                            'label' => 'Berita',
                            'route' => 'dashboard.berita.index',
                            'routes' => [
                                'dashboard.berita.index',
                                'dashboard.berita.create',
                                'dashboard.berita.edit'
                            ]
                        ],
                    ]"
                /> --}}

                {{-- ? akademik --}}
                {{-- <x-dashboard.linkMenu-dropdown
                    id="akademik"
                    title="Akademik"
                    :routes="[
                        'dashboard.guru-staf.index',
                        'dashboard.guru-staf.create',
                        'dashboard.guru-staf.edit',
                        'dashboard.testimoni.index',
                        'dashboard.testimoni.create',
                        'dashboard.testimoni.edit',
                        'dashboard.siswa-berprestasi.index',
                        'dashboard.siswa-berprestasi.create',
                        'dashboard.siswa-berprestasi.edit',
                    ]"
                    :items="[
                        [
                            'label' => 'Guru & Staf',
                            'route' => 'dashboard.guru-staf.index',
                            'routes' => [
                                'dashboard.guru-staf.index',
                                'dashboard.guru-staf.create',
                                'dashboard.guru-staf.edit',
                            ]
                        ],
                        [
                            'label' => 'Testimoni',
                            'route' => 'dashboard.testimoni.index',
                            'routes' => [
                                'dashboard.testimoni.index',
                                'dashboard.testimoni.create',
                                'dashboard.testimoni.edit'
                            ]
                        ],
                        [
                            'label' => 'Siswa Berprestasi',
                            'route' => 'dashboard.siswa-berprestasi.index',
                            'routes' => [
                                'dashboard.siswa-berprestasi.index',
                                'dashboard.siswa-berprestasi.create',
                                'dashboard.siswa-berprestasi.edit',
                            ]
                        ]
                    ]"
                /> --}}

            </ul>
        </div>
    </div>
</div>
