import { showData } from "./getInfoOne.js";


const logProsesDatatable = $('#log-proses-datatables');

$(document).ready(function () {
    // ? datatable
    const datatable = logProsesDatatable.DataTable({
        serverSide: true,
        processing: true,
        autoWidth: false,
        ajax: {
            url: logProsesDatatable.attr('data-url'),
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'Petugas', name: 'Petugas', searchable: true },
            { data: 'Tindakan', name: 'Tindakan', searchable: true, className: 'white-space' },
            { data: 'Deskripsi', name: 'Deskripsi', searchable: false },
            { data: 'Waktu', name: 'Waktu', searchable: false },
            { data: 'Tanggal', name: 'Nama Pengurus/Pegawai', searchable: false },
            { data: 'Aksi', name: 'Aksi', searchable: false },
        ],
        order: [[3, 'desc']],
        rowCallback: function(row, dataTablle) {

            // * action show
            showData(row, function (data, modalBody) {
                const element = `
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                Nama Petugas
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                ${data.petugas}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                Aksi
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                ${data.aksi}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                Tindakan
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                ${data.tindakan}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                Waktu
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                ${data.waktu}
                            </div>
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                Tanggal
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                ${data.tanggal}
                            </div>
                        </li>
                    </ul>
                `;
                modalBody.innerHTML = element;
            });
        }
    }); // ? end init datatable


});
