<x-layouts.dashboard.app title="Berita">
    {{-- * my style --}}
    <x-slot:myStyle>
        {{-- ? sweetalert 2 lib --}}
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">

        {{-- ? toastify css  --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

        <style>
            #basic-datatables_wrapper td.white-space {
                white-space: nowrap;
            }
        </style>
    </x-slot:myStyle>
    {{-- * my style --}}

    {{-- todo content ... --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Pemohon</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <x-dashboard.input-select label="Jenis Pengurusan" name="jenis_pengurusan">
                        @foreach ($jenis_pengurusan as $value )
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </x-dashboard.input-select>
                </div>
                {{-- ? start date --}}
                <div class="col-md-3">
                    <x-dashboard.input
                        label="Tanggal Awal"
                        type="date"
                        name="start_date"
                    />
                </div>
                {{-- ? end date --}}
                <div class="col-md-3">
                    <x-dashboard.input
                        label="Tanggal Akhir"
                        type="date"
                        name="end_date"
                    />
                </div>
            </div>
            <div class="my-4">
                <a href="{{ route('dashboard.pemohon.create') }}" class="btn btn-success">Tambah Pemohon Baru</A>
                <button id="button-filter-reset" class="btn btn-secondary">Reset Filter</button>
            </div>

            <div class="table-responsive">
                <div
                    id="basic-datatables_wrapper"
                    class="dataTables_wrapper container-fluid dt-bootstrap4"
                    >
                    <div class="row">
                        <div class="col-sm-12">
                            <table
                                id="pemohon-datatable"
                                class="display table table-striped table-hover dataTable"
                                role="grid"
                                data-url="{{ route('dashboard.pemohon.fetch') }}"
                                >
                                <thead>
                                    <tr role="row">
                                        <th style="width: 20%;">No</th>
                                        <th style="width: 100%;">NIK</th>
                                        <th style="width: 100%;">Nama Pemohon</th>
                                        <th style="width: 50px;">Jenis Pengurusan</th>
                                        <th style="width: 50px;">Tanggal Pengurusan</th>
                                        <th style="width: 100px">nama Pengurus/Pegawai</th>
                                        <th style="width: 120px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr role="row">
                                        <th style="width: 20%;">No</th>
                                        <th style="width: 100%;">NIK</th>
                                        <th style="width: 100%;">Nama Pemohon</th>
                                        <th style="width: 50px;">Jenis Pengurusan</th>
                                        <th style="width: 50px;">Tanggal Pengurusan</th>
                                        <th style="width: 100px">nama Pengurus/Pegawai</th>
                                        <th style="width: 120px;">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ? modal --}}
    <x-dashboard.modal modalLabel="Detail Kategory" />
    {{-- ? modal --}}

    {{-- todo content ... --}}

    {{-- * my script --}}
    <x-slot:myScript>
        {{-- ? Datatables --}}
        <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
        {{-- ? sweatalert 2 lib --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- ? toastify library  --}}
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        {{-- ? myscript --}}
        <script type="module" src="{{ asset('assets/js/dashboard/pemohon.js') }}"></script>
    </x-slot:myScript>
    {{-- * my script --}}
</x-layouts.dashboard>
