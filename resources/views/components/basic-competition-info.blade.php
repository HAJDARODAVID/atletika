<div class="container mt-3 mx-2 d-flex justify-content-center">
    <div class="" style="width: 750px">
        <div class="row mb-3">
            <div class="col">
                @livewire('input-box-change-data', [
                    'title' => 'Naziv natjecanja',
                    'for' => 'name',
                    'model' => $competition,
                ], key('name'))
            </div>
            <div class="col">
                @livewire('input-box-change-data', [
                    'title' => 'Organizator',
                    'for' => 'organizer',
                    'model' => $competition,
                ], key('organizer'))
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                @livewire('input-box-change-data', [
                    'title' => 'Mjesto',
                    'for' => 'place',
                    'model' => $competition,
                ], key('place'))
            </div>
            <div class="col">
                @livewire('input-box-change-data', [
                    'title' => 'Napomena',
                    'for' => 'remark',
                    'model' => $competition,
                ], key('remark'))
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                @livewire('input-date-change-data', [
                    'title' => 'Početak',
                    'for' => 'from',
                    'model' => $competition,
                ], key('from'))
            </div>
            <div class="col">
                @livewire('input-date-change-data', [
                    'title' => 'Kraj',
                    'for' => 'to',
                    'model' => $competition,
                ], key('to'))
            </div>
        </div>
    </div>
    
    
    {{-- {{ dd($competition) }} --}}
</div>