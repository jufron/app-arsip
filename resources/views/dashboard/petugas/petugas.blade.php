<x-layouts.dashboard.app title="petugas">
    {{-- * my style --}}
    <x-slot:myStyle>
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
    </x-slot:myStyle>
    {{-- * my style --}}

    {{-- todo content ... --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Petugas</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('dashboard.petugas.create') }}" class="btn btn-success my-4">Tambah Petugas Baru</A>
            <div class="table-responsive">
                <div
                    id="basic-datatables_wrapper"
                    class="dataTables_wrapper container-fluid dt-bootstrap4"
                    >
                    <div class="row">
                        <div class="col-sm-12">
                            <table
                                id="basic-datatables"
                                class="display table table-striped table-hover dataTable"
                                role="grid"
                                aria-describedby="basic-datatables_info"
                                >
                                <thead>
                                    <tr role="row">
                                        <th style="width: 50px;">No</th>
                                        <th style="width: 100px;">Username</th>
                                        <th style="width: 100px;">Nama Petugas</th>
                                        <th style="width: 100px;">Tanggal Buat</th>
                                        <th style="width: 100px;">Tanggal Perbaharui</th>
                                        <th style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr role="row">
                                        <th style="width: 50px;">No</th>
                                        <th style="width: 100px;">Username</th>
                                        <th style="width: 100px;">Nama Petugas</th>
                                        <th style="width: 100px;">Tanggal Buat</th>
                                        <th style="width: 100px;">Tanggal Perbaharui</th>
                                        <th style="width: 150px;">Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($user as $u)
                                    <tr role="row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->nama_petugas }}</td>
                                        <td>{{ $u->created_at_format }}</td>
                                        <td>{{ $u->created_at_format }}</td>
                                        <td>
                                            <form id="form-delete" action="{{ route('dashboard.petugas.destroy', $u) }}" method="post">
                                                @method('delete')
                                                @csrf
                                            </form>

                                            <div class="d-flex gap-2">
                                                <button id="button-show" data-url="{{ route('dashboard.petugas.show', $u) }}" type="button" class="btn btn-icon btn-round btn-info">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                                {{-- <a href="{{ route('dashboard.petugas.edit', $u) }}" type="button" class="btn btn-icon btn-round btn-warning">
                                                    <i class="fas fa-edit text-white"></i>
                                                </a> --}}
                                                <button id="button-delete" type="button" class="btn btn-icon btn-round btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ? modal --}}
    <x-dashboard.modal modalLabel="Detail Petugas" />
    {{-- ? modal --}}

    {{-- todo content ... --}}

    {{-- * my script --}}
    <x-slot:myScript>
        {{-- ? Datatables --}}
        <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
        {{-- ? sweatalert 2 lib --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- ? myscript --}}
        <script type="module" src="{{ asset('assets/js/dashboard/petugas.js') }}"></script>
    </x-slot:myScript>
    {{-- * my script --}}
</x-layouts.dashboard>
