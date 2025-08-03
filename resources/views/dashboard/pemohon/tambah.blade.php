<x-layouts.dashboard.app title="Tambah Pemohon Baru">
    {{-- * my style --}}
    <x-slot:myStyle>

    </x-slot:myStyle>
    {{-- * my style --}}

    {{-- todo content ... --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Tambah Pemohon Baru</div>
        </div>

        <form action="{{ route('dashboard.pemohon.store') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <x-dashboard.input
                            label="NIK"
                            name="nik"
                            value="{{ old('nik') }}"
                            placeholder="Masukan NIK"
                        />
                    </div>
                    <div class="col-md-4">
                        <x-dashboard.input
                            label="Nama Lengkap Pemohon"
                            name="nama"
                            value="{{ old('nama') }}"
                            placeholder="Masukan Nama Pemohon"
                        />
                    </div>
                    <div class="col-md-4">
                        <x-dashboard.input-select label="Jenis Pengurusan" name="jenis_pengurusan">
                            @foreach ($jenis_pengurusan as $value )
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </x-dashboard.input-select>
                    </div>
                    <div class="col-md-4">
                        <x-dashboard.input
                            label="Tanggal Pengurusan"
                            name="tanggal_pengurusan"
                            type="date"
                            value="{{ old('tanggal_pengurusan') }}"
                            placeholder="Masukan Tanggal Pengurusan"
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
