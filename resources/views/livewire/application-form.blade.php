<div>
    <div class="form-group mb-2">
        <label for="exampleInputEmail1">NAZIV EKIPE</label>
        <input type="email" class="form-control" id="team" >
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="inputState">GODIŠTE</label>
            <select id="inputState" class="form-control" wire:model.live='yearSelected'>
                <option value=0>Odaberi...</option>
                @foreach ($years as $year)
                  <option value="{{ $year->year }}">{{ $year->year }}</option>
                @endforeach
            </select>
          </div>

        </div>
        <div class="col">
          <div class="form-group">
            <label for="categories">KATEGORIJA</label>
            <select id="categories" class="form-control" wire:model.live='catSelected'>
              <option value=0>Odaberi...</option>
              @foreach ($cat as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <hr>

    @if ($catSelected !=0)
        <table class="table">
            <thead>
                <tr>
                    <td style="width: 20px">#</td>
                    <td style="width: 180px">IME</td>
                    <td style="width: 180px">PREZIME</td>
                    @if ($catSelected == 3)
                        <td style="width: 80px">&#9794; / &#9792;</td>
                    @endif
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= $maxComp; $i++)
                    <tr>
                        <td rowspan="2">{{ $i }}</td>
                        <td><input type="text" class="form-control" id="firstName" wire:model.blur='comp.{{ $i }}.firstName'></td>
                        <td><input type="text" class="form-control" id="lastName" wire:model.blur='comp.{{ $i }}.lastName'></td>
                        @if ($catSelected == 3)
                            <td>
                                <select id="inputState" class="form-control" wire:model.live='comp.{{ $i }}.gender'>
                                    <option value=0>&#9794; / &#9792;</option>
                                    @foreach ($mixCat as $mc)
                                        <option value="{{ $mc->id }}"
                                            @if ($genderCount[$mc->id] >= $maxComp/$ratio) disabled @endif
                                            >
                                            {{ $mc->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        @endif 
                        <td>
                            @if ($yearSelected)
                                @livewire('discipline-modal',[
                                    'athlete' => $i,
                                    'disciplines' => $discipline,
                                    'dsplArray' => $dsplArray
                                ], key(time()))  
                            @endif
                        </td> 
                    </tr> 
                    <tr>
                        <td colspan="2">
                            Discipline: 
                            @if (!is_null($comp[$i]['dspl']))
                                @foreach ($comp[$i]['dspl'] as $key => $value )
                                    @if ($value)
                                        {{ $discipline->where('id', $key)->first()->name }},&nbsp;
                                    @endif   
                                @endforeach  
                            @endif
                            Štafeta
                        </td>
                    </tr>        
                @endfor
            </tbody>
        </table> 
        <hr> 
    @endif

    {{-- @livewire('discipline-modal',[
        'athlete' => 1,
    ], key(1)) --}}

    {{-- @if ($yearSelected !=0)
        <div class="d-flex mb-2">
            <div class="d-flex justify-content-end">
                <x-basic-modal modalName="test" showModal='{{ $showModal }}'>
                    <x-slot name="title">DISCIPLINE</x-slot>
                    <x-slot name="btn">
                        <a class="btn btn-success btn-sm" href="#" wire:click="modal('1')" onclick="showModal('test')" >+</a>
                    </x-slot>
                    <div class="row">
                        <div class="col">
                            <b>Trkače discipline</b><br>
                            <table class="table">  
                                @foreach ($discipline->where('type', 1) as $dspl)
                                    <tr>
                                        <td>{{ $dspl->name }}</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" wire:model.live='dsplArray.{{ $dspl->id }}'>
                                        </td> 
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col">
                            <b>Tehničke discipline</b><br>
                            <table class="table">  
                                @foreach ($discipline->where('type', 2) as $dspl)
                                    <tr>
                                        <td>{{ $dspl->name }}</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" wire:model.live='dsplArray.{{ $dspl->id }}'>
                                        </td> 
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </x-basic-modal>
            </div>
            &nbsp;
            <div class="justify-content-start"><b>Discipline: </b></div>
        </div>
        <x-discipline-modal>     
        </x-discipline-modal>
        &nbsp; - Štafeta,
        <hr>
    @endif --}}

    <button wire:click='test'>test</button><br>

    @foreach ($comp as $key => $c)
        {{ $key }} | {{ $c['firstName'] }} {{ $c['lastName'] }} / G:{{ $c['gender'] }} <br>
    @endforeach
    

    
</div>
