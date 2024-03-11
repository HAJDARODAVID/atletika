<div>
    <div class="form-group">
        <label for="name">{{ $title }}</label>
        <input type="text" class="form-control {{ $showSaved }}" id="name" wire:model.blur='value'>
    </div>
</div>
