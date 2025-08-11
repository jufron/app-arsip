import { showData, deleteData } from "./getInfoOne.js";

$(document).ready(function () {
    // * filter input
    const inputSelectJenisPengurusan = document.querySelector('#jenis_pengurusan');
    const inputStartDate = document.querySelector('#start_date');
    const inputEndDate = document.querySelector('#end_date');

    // * button filter
    const buttonFilterReset = document.querySelector('#button-filter-reset');

    const pemohonDatatable = $('#pemohon-datatable');

    const datatable = pemohonDatatable.DataTable({
        serverSide: true,
        processing: true,
        autoWidth: false,
        ajax: {
            url: pemohonDatatable.attr('data-url'),
            data: function(d) {
                // * filter data jika nanti diperlukan
                // if (inputSelectJenisPengurusan.value !== null && inputSelectJenisPengurusan.value !== '') {
                //     d.jenis_pengurusan = inputSelectJenisPengurusan.value;
                // }
                // if (inputStartDate.value !== null && inputStartDate.value !== '') {
                //     d.start_date  = inputStartDate.value;
                // }
                // if (inputEndDate.value !== null && inputEndDate.value !== '') {
                //     d.end_date  = inputEndDate.value;
                // }
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'Nik', name: 'Nik', searchable: true },
            { data: 'Nama', name: 'Nama', searchable: true, className: 'white-space' },
            { data: 'Jenis Pengurusan', name: 'Jenis Pengurusan', searchable: false },
            { data: 'Tanggal Pengurusan', name: 'Tanggal Pengurusan', searchable: false },
            { data: 'Nama Pengurus/Pegawai', name: 'Nama Pengurus/Pegawai', searchable: false },
            { data: 'Aksi', name: 'Aksi', searchable: false },
        ],
        order: [[3, 'desc']],
        rowCallback: function(row, dataTablle) {

            // * action show
            showData(row, function (data, modalBody) {
                console.log(data);
                const element = `
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                NIK
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                ${data.nik}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                Nama
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                ${data.nama}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                Jenis Pengurusan
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                ${data.jenis_pengurusan}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                Tanggal Pengurusan
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                ${data.tanggal_pengurusan}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                Nama Pengurus/Pegawai
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                ${data.nama_petugas}
                            </div>
                        </li>
                    </ul>
                    <br>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                Tanggal Buat
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                ${data.created_at}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                Tanggal Perbaharui
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                                ${data.updated_at}
                            </div>
                        </li>
                    </ul>
                `;
                modalBody.innerHTML = element;
            });

            // * action delete
            deleteData(row);
        }
    }); // ? end init datatable

    // * handle button reset
    buttonFilterReset.addEventListener('click', function () {
        inputSelectJenisPengurusan.value = '';
        inputEndDate.value = '';
        inputStartDate.value = '';

        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Seluruh Filter Direset');
    });

    // * filter handler
    inputSelectJenisPengurusan.addEventListener('change', function () {
        console.log(inputSelectJenisPengurusan.value, 'reload data');
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter dengan Jenis Pengurusan');
    });
    inputStartDate.addEventListener('change', function () {
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter dengan Tanggal Mulai');
    });
    inputEndDate.addEventListener('change', function () {
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter dengan Tanggal Selesai');
    });

    // * toastify js
    function handleToastlifyPopUp (label) {
        Toastify({
            text: label,
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
              background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
            onClick: function(){} // Callback after click
        }).showToast();
    }
}); // ? ready document
