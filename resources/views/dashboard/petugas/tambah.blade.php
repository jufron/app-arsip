<x-layouts.dashboard.app title="Tambah Petugas Baru">
    {{-- * my style --}}
    <x-slot:myStyle>

    </x-slot:myStyle>
    {{-- * my style --}}

    {{-- todo content ... --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Tambah Petugas Baru</div>
        </div>

        <form action="{{ route('dashboard.petugas.store') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <x-dashboard.input
                            label="Username"
                            name="username"
                            value="{{ old('username') }}"
                            placeholder="Masukan Username"
                        />
                    </div>
                    <div class="col-md-4">
                        <x-dashboard.input
                            label="Nama Petugas"
                            name="nama_petugas"
                            value="{{ old('nama_petugas') }}"
                            placeholder="Masukan Nama Petugas"
                        />
                    </div>
                    <div class="col-md-4">
                        <x-dashboard.input
                            label="Email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            placeholder="Masukan Email"
                        />
                    </div>
                    <div class="col-md-4">
                        <x-dashboard.input
                            label="Password"
                            name="password"
                            type="password"
                            value="{{ old('password') }}"
                            placeholder="Masukan Password"
                        />
                    </div>
                    <div class="col-md-4">
                        <x-dashboard.input
                            label="Konfirmasi Password"
                            name="password_confirmation"
                            type="password"
                            value="{{ old('password_confirmation') }}"
                            placeholder="Masukan Konfirmasi Password"
                        />
                    </div>
                </div>
            </div>
            <div class="card-action">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
    {{-- todo content ... --}}

    {{-- * my script --}}
    <x-slot:myScript>

    </x-slot:myScript>
    {{-- * my script --}}
</x-layouts.dashboard>
