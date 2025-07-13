

// ? action delete
function deleteData (element) {
    const formDelete = element.querySelector('#form-delete');
    const buttonDelete = element.querySelector('#button-delete');

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
                formDelete.submit();
            }
        });
    })
}

// ? modal
const myModalEl = document.querySelector('#modalDetail');
const modalContent = document.querySelector('#modalContent');
const modalCloseButton = document.querySelector('#modalCloseButton');

const modal = new bootstrap.Modal(myModalEl);

// ? action show
function showData (element, callback) {
    const buttonShow = element.querySelector('#button-show');

    // * modal open
    buttonShow.addEventListener('click', () => {
        modal.show();

        const url = buttonShow.getAttribute('data-url');

        getData(url, modalContent, callback);

        renderLoading(modalContent, true);
    });

    // * modal close
    modalCloseButton.addEventListener('click', () => {
        modal.hide();
        // buttonShow.focus();
    });

}


const getData = (dataUrl, modalContent, callback) => {
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
            renderLoading(modalContent, false);
            callback(data, modalContent);
        })
        .catch(err => {
            renderLoading(modalContent, false);
            console.error('Fetch error:', err);
            renderErrorMessage(
                modalContent,
                `An error occurred: ${err.message}`,
                `${err.status}`
            );
        });
};

const renderErrorMessage = (message, modalContent, statusCode) => {
    modalContent.innerHTML = `
        <h1 class="text-center mt-3">${statusCode}</h1>
        <div class="text-center mb-3">${message}</div>
    `;
};

const renderLoading = (modalBody, data) => {
    if (data) {
        const element = `
            <div class="d-flex justify-content-center">
                <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        `;
        modalBody.innerHTML = element;
    } else {
        modalBody.innerHTML = '';
    }
};

export { showData, deleteData };
