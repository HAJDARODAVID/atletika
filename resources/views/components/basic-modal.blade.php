<div>
    {{ $btn }}

    <!-- Modal -->
    <div class="modal" id="{{ $modalName }}" style="display: {{ $showModal }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
                </div>
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  wire:click="modal('0')">ZATVORI</button>
                </div>
            </div>
        </div>
    </div>
</div>