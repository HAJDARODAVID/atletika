<div>
    <a class="btn btn-success btn-sm" href="#" onclick="showModal('modalName')">+</a>

    <!-- Modal -->
    <div class="modal" id="modalName" style="display: none">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">NASLOV</h5>
                </div>
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">ZATVORI</button>
                </div>
            </div>
        </div>
    </div>
</div>