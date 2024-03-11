<div>
    <div class="form-group">
        <label for="name">{{ $title }}</label>
        <input type="date" class="form-control {{ $showSaved }}" id="name" wire:model.blur='value'>
    </div>
</div>
