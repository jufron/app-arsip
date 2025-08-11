<x-layouts.dashboard.app title="Ubah Data Arsip">
    {{-- * my style --}}
    <x-slot:myStyle>
        {{-- ? sweetalert 2 lib --}}
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">

    </x-slot:myStyle>
    {{-- * my style --}}

    {{-- todo content ... --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Ubah Data Arsip</div>
        </div>

        <div class="card-body">
            {{-- ? input disable --}}
            <div class="row">
                {{-- ? dokumen_pemohon_id --}}
                <div class="col-md-4">
                    <x-dashboard.input
                        label="Nama Lengkap Pemohon"
                        name="dokumen_pemohon_id"
                        disable="true"
                        value="{{ old('nik', $arsip->dokumenPemohon->nama) }}"
                    />
                </div>
                {{-- ? nik --}}
                <div class="col-md-4">
                    <x-dashboard.input
                        label="NIK"
                        name="nik"
                        disable="true"
                        value="{{ old('nik', $arsip->dokumenPemohon->nik) }}"
                    />
                </div>
                {{-- ? jenis pengurusan --}}
                <div class="col-md-4">
                    <x-dashboard.input
                        label="Jenis Pengurusan"
                        name="jenis_pengurusan"
                        disable="true"
                        value="{{ old('jenis_pengurusan', $arsip->dokumenPemohon->jenis_pengurusan) }}"
                    />
                </div>
                {{-- ? tanggal pengurusan --}}
                <div class="col-md-4">
                    <x-dashboard.input
                        label="Tanggal Pengurusan"
                        name="tanggal_pengurusan"
                        disable="true"
                        value="{{ old('tanggal_pengurusan', $arsip->dokumenPemohon->tanggal_pengurusan) }}"
                    />
                </div>
                {{-- ? nama pengurus/pegawai --}}
                <div class="col-md-4">
                    <x-dashboard.input
                        label="Nama Pengurus"
                        name="nama_petugas"
                        disable="true"
                        value="{{ old('nama_petugas', $arsip->dokumenPemohon->user->nama_petugas) }}"
                    />
                </div>
            </div>

            {{-- ? table --}}
            <div class="row my-3">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Foto</th>
                            <th scope="col">tanggal Upload</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arsip->files as $file)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                <img
                                    src="{{ asset('storage/' . $file->nama_file) }}"
                                    alt="file-foto"
                                    class="img-fluid"
                                    loading="lazy"
                                    width="30px"
                                />
                            </td>
                            <td>
                                {{ $file->created_at_format }}
                            </td>
                            <td>
                                <form id="form-delete" action="{{ route('dashboard.fileArsip.destroy', $file) }}" method="post">
                                    @method('delete')
                                    @csrf
                                </form>

                                <a href="{{ route('dashboard.fileArsip.donwload', $file) }}" type="button" class="btn btn-icon btn-round btn-success">
                                    <i class="fas fa-download text-white"></i>
                                </a>
                                <button id="button-delete" type="button" class="btn btn-icon btn-round btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <form action="{{ route('dashboard.arsip.update', $arsip) }}" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf

                {{-- ? preview image --}}
                <div id="preview" class="row">

                </div>
                {{-- ? message error maximum file --}}
                <div id="error_nama_file_maximum_upload" class="my-3">

                </div>
                @error('nama_file')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <div class="row">
                    {{-- ? nama file --}}
                    <div class="col-md-5 mt-3">
                        <label for="nama_file" class="form-label">File Arsip</label>
                        <input
                            class="form-control"
                            name="files[]"
                            type="file"
                            id="nama_file"
                            accept="image/*"
                            capture="environment"
                            multiple
                        />
                    </div>
                    {{-- ? ruangan --}}
                    <div class="col-md-3">
                        <x-dashboard.input-select label="Ruangan" name="ruangan" required>
                            @foreach ($number as $n )
                                <option
                                    value="{{ 'ruangan '. $n }}"
                                    @if($arsip->ruangan === 'ruangan '. $n) selected @endif
                                >{{ 'ruangan '. $n }}</option>
                            @endforeach
                        </x-dashboard.input-select>
                    </div>
                    {{-- ? lemari --}}
                    <div class="col-md-3">
                        <x-dashboard.input-select label="Lemari" name="lemari" required>
                            @foreach ($number as $n )
                                <option
                                    value="{{ 'lemari '. $n }}"
                                    @if($arsip->lemari === 'lemari '. $n) selected @endif
                                >{{ 'lemari '. $n }}</option>
                            @endforeach
                        </x-dashboard.input-select>
                    </div>
                    {{-- ? rak --}}
                    <div class="col-md-3">
                        <x-dashboard.input-select label="Rak" name="rak" required>
                            @foreach ($number as $n )
                                <option
                                    value="{{ 'rak '. $n }}"
                                    @if($arsip->rak === 'rak '. $n) selected @endif
                                    >{{ 'rak '. $n }}</option>
                            @endforeach
                        </x-dashboard.input-select>
                    </div>
                    {{-- ? laci --}}
                    <div class="col-md-3">
                        <x-dashboard.input-select label="Laci" name="laci" required>
                            @foreach ($number as $n )
                                <option
                                    value="{{ 'laci '. $n }}"
                                    @if($arsip->laci === 'laci '. $n) selected @endif
                                    >{{ 'laci '. $n }}</option>
                            @endforeach
                        </x-dashboard.input-select>
                    </div>
                    {{-- ? box --}}
                    <div class="col-md-3">
                        <x-dashboard.input-select label="Box" name="box" required>
                            @foreach ($number as $n )
                                <option
                                    value="{{ 'box '. $n }}"
                                    @if($arsip->box === 'box '. $n) selected @endif
                                    >{{ 'box '. $n }}</option>
                            @endforeach
                        </x-dashboard.input-select>
                    </div>
                    {{-- ? tanggal arsip --}}
                    <div class="col-md-3">
                        <x-dashboard.input
                            label="Tanggal Arsip"
                            name="tanggal_arsip"
                            type="date"
                            value="{{ old('tanggal_arsip', $arsip->tanggal_arsip) }}"
                        />
                    </div>
                    {{-- ? keterangan --}}
                    <div class="col-md-12">
                        <x-dashboard.input-textarea
                            label="Keterangan"
                            name="keterangan"
                            placeholder="Masukkan keterangan arsip"
                            rows="3"
                            value="{{ old('keterangan', $arsip->keterangan) }}"
                        />
                    </div>
                </div>
                <button type="submit" class="btn btn-success my-3">Perbaharui</button>
            </form>
        </div>
    </div>
    {{-- todo content ... --}}

    {{-- * my script --}}
    <x-slot:myScript>
        {{-- ? sweatalert 2 lib --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            // upload  file maximum 5
            document.getElementById('nama_file').addEventListener('change', function (e) {
                const maxFiles = 5;
                const warning = document.getElementById('error_nama_file_maximum_upload');

                if (this.files.length > maxFiles) {
                    warning.innerHTML = `
                        <div class="alert alert-danger" role="alert">
                            Maksimal hanya bisa mengupload ${maxFiles} file
                        </div>`;

                    this.value = ''; // reset input file
                } else {
                    warning.textContent = '';
                }
            });
        </script>

        <script>
            // ? previewe
            const preview = document.getElementById('preview');

            document.getElementById('nama_file').addEventListener('change', function (e) {
                preview.innerHTML = '';

                const files = Array.from(this.files);

                files.forEach(file => {
                    if (!file.type.startsWith('image/')) return;

                    const reader = new FileReader();

                    reader.onload = function (e) {
                        const elementImage = `
                        <div class="col-md-2 border border-dark">
                            <img
                            src="${e.target.result}"
                            class="bg-secondary card-img-top rounded-lg"
                            id="photo_preview"
                            alt="Preview-image"
                            loading="lazy"
                            width="100%"
                            />
                        </div>
                        `;

                        // Tambahkan HTML ke dalam container preview
                        preview.insertAdjacentHTML('beforeend', elementImage);
                    };

                    reader.readAsDataURL(file);
                });

            });
        </script>

        <script>
            const formDeleteAll = document.querySelectorAll('form#form-delete');
            const buttonDeleteAll = document.querySelectorAll('#button-delete');

            buttonDeleteAll.forEach((buttonDelete, index) => {
                buttonDelete.addEventListener('click', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: "Apakah Anda Yakin?",
                        text: "Yakin Ingin Menghapus File Tersebut!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Ya Hapus!",
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            formDeleteAll[index].submit();
                        }
                    });
                })
            });
        </script>
    </x-slot:myScript>
    {{-- * my script --}}
</x-layouts.dashboard>
