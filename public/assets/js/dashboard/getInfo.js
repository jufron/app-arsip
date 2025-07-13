
// ? action delete
const allFormDelete = document.querySelectorAll('#form-delete');
const allButtonDelete = document.querySelectorAll('#button-delete');

allButtonDelete.forEach((buttonDelete, index) => {
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
                allFormDelete[index].submit();
            }
        });
    })
});

// action show
const myModalEl = document.querySelector('#modalDetail');
const modalContent = document.querySelector('#modalContent');
const modalCloseButton = document.querySelector('#modalCloseButton');

const modal = new bootstrap.Modal(myModalEl);

const allButtonShow = document.querySelectorAll('#button-show');

function showDetail (callback) {
    allButtonShow.forEach((buttonShow) => {
        buttonShow.addEventListener('click', () => {
            modal.show();

            const url = buttonShow.getAttribute('data-url');

            getData(url, callback);

            renderLoading(true);
        });
        modalCloseButton.addEventListener('click', () => {
            modal.hide();
            buttonModal.focus();
        });
    });
}

const getData = (dataUrl, callback) => {
    fetch(dataUrl)
        .then(ress => {
            if (!ress.ok) {
                throw {
                    status: ress.status,
                    message: ress.statusText || 'Unknown error'
                };
            }
            return ress.json();
        })
        .then(data => {
            renderLoading(false);
            callback(
                data,
                modalContent
            );
        })
        .catch(err => {
            renderLoading(false);
            console.error('Fetch error:', err);
            renderErrorMessage(
                `An error occurred: ${err.message}`,
                `${err.status}`
            );
        });
};

const renderErrorMessage = (message, statusCode) => {
    modalContent.innerHTML = `
        <h1 class="text-center mt-3">${statusCode}</h1>
        <div class="text-center mb-3">${message}</div>
    `;
};

const renderLoading = (data) => {
    if (data) {
        const element = `
            <div class="d-flex justify-content-center">
                <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        `;
        modalContent.innerHTML = element;
    } else {
        modalContent.innerHTML = '';
    }
};

export default showDetail;
