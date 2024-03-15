<div style="display: inline">
    <a class="btn btn-{{ $isComplete }} btn-sm" href="#" wire:click="changeModalStatus('1')"><i class="bi bi-person-lines-fill"></i></a>

    <!-- Modal -->
    <div class="modal" id="modalName" style="display: {{ $modalShowStatus }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informacije o natjecatelju: {{ $athleteName }}</h5>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control @if($error['address']) is-invalid @endif" id="inputAddress" placeholder="1234 Main St" wire:model.blur='info.address'>
                            
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-group col-md-5">
                            <label for="inputCity">Grad</label>
                            <input type="text" class="form-control @if($error['city']) is-invalid @endif" id="inputCity" wire:model.blur='info.city'>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState">Država</label>
                            <select id="inputState" class="form-control @if($error['state']) is-invalid @endif" wire:model.blur='info.state'>
                                <option selected>Choose...</option>
                                @foreach ($state as $st)
                                    <option value="{{ $st->short_txt }}">{{ $st->cro }}</option>    
                                @endforeach
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputZip">Zip</label>
                            <input type="text" class="form-control @if($error['zip']) is-invalid @endif" id="inputZip" wire:model.number.live='info.zip'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="athlete_id">Br. osobne iskaznice / putovnice</label>
                            <input type="text" class="form-control @if($error['athlete_id']) is-invalid @endif" id="athlete_id" wire:model.blur='info.athlete_id' />
                            @isset($error['athlete_id'.'is-in-app'])
                            <div class="text-danger">
                                <i>Natjecatelj se nalazi unutar ove prijavnice!!</i>
                            </div>
                            @endisset
                            
                        </div>    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="changeModalStatus()">ZATVORI</button>
                </div>
            </div>
        </div>
    </div>
</div>