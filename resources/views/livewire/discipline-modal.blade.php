<div>
    <a class="btn btn-{{ $isComplete }} btn-sm" href="#" wire:click="changeModalStatus('1')">+</a>

    <!-- Modal -->
    <div class="modal" id="modalName" style="display: {{ $modalShowStatus }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">NASLOV {{ $athlete }}</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <b>Trkače discipline</b><br>
                            <table class="table">  
                                @foreach ($disciplines->where('type', 1) as $dspl)
                                    <tr>
                                        <td>{{ $dspl->name }}</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" wire:model.live='dsplArray.{{ $dspl->id }}' 
                                            @if ($dsplCount[1]>=2 && !$dsplArray[$dspl->id]) disabled @endif>
                                        </td> 
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col">
                            <b>Tehničke discipline</b><br>
                            <table class="table">  
                                @foreach ($disciplines->where('type', 2) as $dspl)
                                    <tr>
                                        <td>{{ $dspl->name }}</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" wire:model.live='dsplArray.{{ $dspl->id }}' 
                                            @if ($dsplCount[2]>=2 && !$dsplArray[$dspl->id]) disabled @endif>
                                        </td> 
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    @foreach ($dsplCount as $key => $d)
                        {{$key }} - {{ $d }}
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="changeModalStatus()">ZATVORI</button>
                </div>
            </div>
        </div>
    </div>
</div>