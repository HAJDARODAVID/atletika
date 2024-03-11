<div style="display: inline">
    <a class="btn btn-success btn-sm" href="#" wire:click="changeModalStatus('1')">NOVO NATJECANJE</a>

    <!-- Modal -->
    <div class="modal" id="modalName" style="display: {{ $modalShowStatus }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Otvori novo natjecanje</h5>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="form-group col">
                            <label for="name">Naziv</label>
                            <input type="text" class="form-control @isset($error['name']) is-invalid @endisset" id="name" wire:model.blur='compInfo.name'>
                        </div>
                        <div class="form-group col">
                            <label for="organizer">Organizator</label>
                            <input type="text" class="form-control @isset($error['organizer']) is-invalid @endisset" id="organizer" wire:model.blur='compInfo.organizer'>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-group col">
                            <label for="place">Mjesto</label>
                            <input type="text" class="form-control @isset($error['place']) is-invalid @endisset" id="place" wire:model.blur='compInfo.place'>
                        </div>
                        <div class="form-group col">
                            <label for="remark">Napomena</label>
                            <input type="text" class="form-control @isset($error['remark']) is-invalid @endisset" id="remark" wire:model.blur='compInfo.remark'>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-group col">
                            <label for="from">Početak</label>
                            <input type="date" class="form-control @isset($error['from']) is-invalid @endisset" id="from" wire:model.blur='compInfo.from'>
                        </div>
                        <div class="form-group col">
                            <label for="to">Kraj</label>
                            <input type="date" class="form-control @isset($error['to']) is-invalid @endisset" id="to" wire:model.blur='compInfo.to'>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" wire:click="save()">SPREMI</button>
                    <button type="button" class="btn btn-secondary" wire:click="changeModalStatus()">ZATVORI</button>
                </div>
                @foreach ($compInfo as $key => $value)
                    {{ $key }} => {{ $value }} <br>
                @endforeach
            </div>
        </div>
    </div>
</div>