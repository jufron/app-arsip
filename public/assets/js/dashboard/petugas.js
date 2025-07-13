import showDetail from "./getInfo.js";

$(document).ready(function () {

    $("#basic-datatables").DataTable({});

}); // ? ready document


// ? button show
showDetail(function (data, modalContent) {
    // console.log(data);
    const element = `
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <div class="col-md-6 font-weight-bold">
                Username
            </div>
            <div class="col-md-6">
                ${data.username}
            </div>
        </li>
        <li class="list-group-item">
            <div class="col-md-6 font-weight-bold">
                Nama Petugas
            </div>
            <div class="col-md-6">
                ${data.nama_petugas}
            </div>
        </li>
        <li class="list-group-item">
            <div class="col-md-6 font-weight-bold">
                Email
            </div>
            <div class="col-md-6">
                ${data.email}
            </div>
        </li>
        <li class="list-group-item">
            <div class="col-md-6 font-weight-bold">
                Tanggal Buat
            </div>
            <div class="col-md-6">
                ${data.created_at}
            </div>
        </li>
        <li class="list-group-item">
            <div class="col-md-6 font-weight-bold">
                Tanggal Perbaharui
            </div>
            <div class="col-md-6">
                ${data.updated_at}
            </div>
        </li>
    </ul>
    `;
    modalContent.innerHTML = element;
});
