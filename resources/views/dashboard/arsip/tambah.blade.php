<x-layouts.dashboard.app title="Tambah Arsip Baru">
    {{-- * my style --}}
    <x-slot:myStyle>

    </x-slot:myStyle>
    {{-- * my style --}}

    {{-- todo content ... --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Tambah Arsip Baru</div>
        </div>

        <form action="{{ route('dashboard.arsip.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    {{-- ? dokumen_pemohon_id --}}
                    <div class="col-md-4">
                        <x-dashboard.input-select label="Nama lengkap Pemohon" name="dokumen_pemohon_id" required>
                            @foreach ($dokumen_pemohon as $dp )
                                <option value="{{ $dp->id }}">{{ $dp->nama }}</option>
                            @endforeach
                        </x-dashboard.input-select>
                    </div>
                </div>

                <div class="row">
                    {{-- ? nik --}}
                    <div class="col-md-4">
                        <x-dashboard.input
                            label="NIK"
                            name="nik"
                            disable="true"
                        />
                    </div>
                    {{-- ? jenis pengurusan --}}
                    <div class="col-md-4">
                        <x-dashboard.input
                            label="Jenis Pengurusan"
                            name="jenis_pengurusan"
                            disable="true"
                        />
                    </div>
                    {{-- ? tanggal pengurusan --}}
                    <div class="col-md-4">
                        <x-dashboard.input
                            label="Tanggal Pengurusan"
                            name="tanggal_pengurusan"
                            disable="true"
                        />
                    </div>
                    {{-- ? nama pengurus/pegawai --}}
                    <div class="col-md-4">
                        <x-dashboard.input
                            label="Nama Pengurus"
                            name="nama_pengurus"
                            disable="true"
                        />
                    </div>
                </div>

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
                                <option value="{{ 'ruangan '. $n }}">{{ 'ruangan '. $n }}</option>
                            @endforeach
                        </x-dashboard.input-select>
                    </div>
                    {{-- ? lemari --}}
                    <div class="col-md-3">
                        <x-dashboard.input-select label="Lemari" name="lemari" required>
                            @foreach ($number as $n )
                                <option value="{{ 'lemari '. $n }}">{{ 'lemari '. $n }}</option>
                            @endforeach
                        </x-dashboard.input-select>
                    </div>
                    {{-- ? rak --}}
                    <div class="col-md-3">
                        <x-dashboard.input-select label="Rak" name="rak" required>
                            @foreach ($number as $n )
                                <option value="{{ 'rak '. $n }}">{{ 'rak '. $n }}</option>
                            @endforeach
                        </x-dashboard.input-select>
                    </div>
                    {{-- ? laci --}}
                    <div class="col-md-3">
                        <x-dashboard.input-select label="Laci" name="laci" required>
                            @foreach ($number as $n )
                                <option value="{{ 'laci '. $n }}">{{ 'laci '. $n }}</option>
                            @endforeach
                        </x-dashboard.input-select>
                    </div>
                    {{-- ? box --}}
                    <div class="col-md-3">
                        <x-dashboard.input-select label="Box" name="box" required>
                            @foreach ($number as $n )
                                <option value="{{ 'box '. $n }}">{{ 'box '. $n }}</option>
                            @endforeach
                        </x-dashboard.input-select>
                    </div>
                    {{-- ? tanggal arsip --}}
                    <div class="col-md-3">
                        <x-dashboard.input
                            label="Tanggal Arsip"
                            name="tanggal_arsip"
                            type="date"
                            value="{{ old('tanggal_arsip', now()->format('Y-m-d')) }}"
                        />
                    </div>
                    {{-- ? keterangan --}}
                    <div class="col-md-12">
                        <x-dashboard.input-textarea
                            label="Keterangan"
                            name="keterangan"
                            placeholder="Masukkan keterangan arsip"
                            rows="3"
                            value="{{ old('keterangan') }}"
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
        <script>
            // Fetch data pemohon when select changes
            const input_select = document.querySelector('select[name="dokumen_pemohon_id"]');

            input_select.addEventListener('change', function() {
                const id = this.value;
                const route = `{{ route('dashboard.pemohon.get', ':id') }}`.replace(':id', id);

                fetch(route)
                    .then(response => response.json())
                    .then(data => {
                        document.querySelector('input[name="nik"]').value = data.nik;
                        document.querySelector('input[name="jenis_pengurusan"]').value = data.jenis_pengurusan;
                        document.querySelector('input[name="tanggal_pengurusan"]').value = data.tanggal_pengurusan;
                        document.querySelector('input[name="nama_pengurus"]').value = data.nama_petugas;
                    })
                    .catch(error => console.error('Error fetching data:', error));
            });
        </script>

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
    </x-slot:myScript>
    {{-- * my script --}}
</x-layouts.dashboard>
