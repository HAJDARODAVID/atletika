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
                    <td style="width: 30px">#</td>
                    <td style="width: 150px">IME</td>
                    <td style="width: 150px">PREZIME</td>
                    @if ($catSelected == 3)
                        <td>&#9794; / &#9792;</td>
                    @endif
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= $maxComp; $i++)
                    <tr>
                        <td>{{ $i }}</td>
                        <td><input type="text" class="form-control" id="firstName" wire:model.blur='comp.{{ $i }}.firstName'></td>
                        <td><input type="text" class="form-control" id="lastName" wire:model.blur='comp.{{ $i }}.lastName'></td>
                        @if ($catSelected == 3)
                            <td>
                                <select id="inputState" class="form-control" wire:model.live='comp.{{ $i }}.gender'>
                                    <option value=0>Odaberi...</option>
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
                    </tr>        
                @endfor
            </tbody>
        </table> 
        <hr> 
    @endif

    

    @if ($yearSelected !=0)
        <b>Discipline:</b><br>
        &nbsp; - štafeta,
        <hr>
    @endif
    

    <button wire:click='test'>test</button>
    

    
</div>
