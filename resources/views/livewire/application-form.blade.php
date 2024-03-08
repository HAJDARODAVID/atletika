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
                            @if ($comp[$i]['firstName'] && $comp[$i]['lastName'])
                                @livewire('personal-info-modal', [
                                    'athlete' => $i,
                                    'athleteName' => $comp[$i]['firstName'] .' '. $comp[$i]['lastName'],
                                    'info' => $comp[$i]['info'],
                                ], key(date('h-m-s')))   
                                @if ($yearSelected)
                                    @livewire('discipline-modal',[
                                        'athlete' => $i,
                                        'disciplines' => $discipline,
                                        'dsplArray' => $comp[$i]['dspl'] != NULL ? $comp[$i]['dspl'] :$dsplArray
                                    ], key(date('h-m-s')))  
                                @endif 
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

    <button wire:click='test'>test</button><br>

    @foreach ($comp as $key => $c)
        {{ $key }} | {{ $c['firstName'] }} {{ $c['lastName'] }} / G:{{ $c['gender'] }} <br>
        @foreach ($c['info'] as $k => $v)
            &nbsp; - {{ $k }} - {{ $v }} <br>
        @endforeach
    @endforeach
    

    
</div>
