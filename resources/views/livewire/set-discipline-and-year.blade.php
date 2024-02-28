<div style="width: auto">
    <table class="table">
        <thead>
            <tr>
                <td></td>
                @foreach ($years as $year)
                    <td>
                        <button class="btn btn-danger btn-sm" style="height: 15px" wire:click='deactivateYear({{ $year }})'></button>
                        <b>{{  $year->year }}</b>
                    </td>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($disciplines as $dspl)
                <tr>
                    <td>
                        <button class="btn btn-danger btn-sm" style="height: 15px" wire:click='deactivateDspl({{ $dspl }})'></button> 
                        <b>{{ $dspl->name }}</b>
                    </td>
                    @foreach ($years as $year)
                        <td><input class="form-check-input" type="checkbox"  wire:model.live='dataCB.{{ $dspl->id .'_'. $year->year }}'></td>
                    @endforeach
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
