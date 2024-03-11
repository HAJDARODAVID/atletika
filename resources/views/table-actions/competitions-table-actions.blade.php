<div>
    @livewire('update-competition-btn', [
            'type' => 'finished',
            'competition' => $row,
        ], key('finished'.$row->id))

    @livewire('update-competition-btn', [
            'type' => 'delete',
            'competition' => $row,
        ], key('delete'.$row->id))

    
</div>