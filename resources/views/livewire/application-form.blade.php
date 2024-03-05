<div>
    <div class="form-group mb-2">
        <label for="exampleInputEmail1">NAZIV EKIPE</label>
        <input type="email" class="form-control" id="team" >
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="inputState">GODIŠTE</label>
            <select id="inputState" class="form-control">
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
                @for ($i = 1; $i <= 4; $i++)
                    <tr>
                        <td>{{ $i }}</td>
                        <td><input type="email" class="form-control" id="team" ></td>
                        <td><input type="email" class="form-control" id="team" ></td>
                        @if ($catSelected == 3)
                            <td>
                                <select id="inputState" class="form-control">
                                    <option value=0>Odaberi...</option>
                                    @foreach ($mixCat as $mc)
                                        <option value="{{ $mc->id }}">{{ $mc->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        @endif  
                    </tr>        
                @endfor
            </tbody>
        </table>  
    @endif
    

    
</div>
