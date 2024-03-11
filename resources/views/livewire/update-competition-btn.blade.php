<div style="display: inline">
    @if ($type == 'finished')
        <button class="btn btn-success btn-sm" wire:click='update()'><i class="bi bi-flag"></i></button> 
    @endif
    @if ($type == 'delete')
        <button class="btn btn-danger btn-sm" wire:click='update()'><i class="bi bi-trash"></i></button> 
    @endif
</div>
