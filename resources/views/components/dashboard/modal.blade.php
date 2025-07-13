@props(['modalLabel', 'modalSize' => ''])
<div
    class="modal fade"
    id="modalDetail"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="modalDetailLabel"
    aria-hidden="true"
    >
    <div @class([
        'modal-dialog modal-dialog-centered modal-dialog-scrollable',
        'modal-xl'  => $modalSize == 'xl',
        'modal-lg'   => $modalSize == 'lg',
        ])>
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalDetailLabel">{{ $modalLabel }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="modalCloseButton">Tutup</button>
            </div>
        </div>
    </div>
</div>
