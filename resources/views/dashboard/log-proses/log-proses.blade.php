<x-layouts.dashboard.app title="log aktivitas">
    {{-- * my style --}}
    <x-slot:myStyle>
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
    </x-slot:myStyle>
    {{-- * my style --}}

    {{-- todo content ... --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Log Aktifitas</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div
                    id="basic-datatables_wrapper"
                    class="dataTables_wrapper container-fluid dt-bootstrap4"
                    >
                    <div class="row">
                        <div class="col-sm-12">
                            <table
                                id="log-proses-datatables"
                                class="display table table-striped table-hover dataTable"
                                role="grid"
                                data-url="{{ route('dashboard.log-aktifitas.fetch') }}"
                                aria-describedby="basic-datatables_info"
                                >
                                <thead>
                                    <tr role="row">
                                        <th style="width: 50px;">No</th>
                                        <th style="width: 100px;">Petugas</th>
                                        <th style="width: 100px;">Tindakan</th>
                                        <th style="width: 100px;">Deskripsi</th>
                                        <th style="width: 100px;">Waktu</th>
                                        <th style="width: 100px;">Tanggal</th>
                                        <th style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr role="row">
                                        <th style="width: 50px;">No</th>
                                        <th style="width: 100px;">Petugas</th>
                                        <th style="width: 100px;">Tindakan</th>
                                        <th style="width: 100px;">Deskripsi</th>
                                        <th style="width: 100px;">Waktu</th>
                                        <th style="width: 100px;">Tanggal</th>
                                        <th style="width: 150px;">Aksi</th>
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
    <x-dashboard.modal modalLabel="Detail Log Aktivitas" />
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
        <script type="module" src="{{ asset('assets/js/dashboard/log-aktifitas.js') }}"></script>
    </x-slot:myScript>
    {{-- * my script --}}
</x-layouts.dashboard>
