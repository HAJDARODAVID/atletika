@extends('layouts.admin')

@section('content')
<div class="container mt-3">
   <h5>Pregled tiketa</h5>
   <hr>
   <div class="container ml-5">
      @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
      @endif
      <div class="row">
         <div class="col">
            <div class="container">
               <h6>Obrazac za novi ticket</h6>
               <form action="{{ route('newTickets') }}" method="post" id="newTicketForm">
                  @csrf
                  @method('POST')
                  <div class="form-group mb-3">
                     <label for="name">Naziv tiketa</label>
                     <input type="text" name="name" class="form-control @error('name') is-invalid  @enderror" id="name" value="{{ old('name') }}">
                  </div>
                  <div class="form-group mb-3">
                     <label for="body">Opis potrebnih radova</label>
                     <textarea name="body" class="form-control @error('body') is-invalid  @enderror" id="body" rows="3" value="{{ old('body') }}"></textarea>
                  </div>
                  <div class="form-group col-md-4 mb-3">
                     <label for="priorities">Prioritet</label>
                     <select id="priorities" name="priority" class="form-control">
                        @foreach ($priorities as $key => $priority)
                           <option value="{{ $key }}" @if ($key == 2) selected @endif>{{ $priority }}</option>
                        @endforeach
                     </select>
                  </div>
               </form>
               

               <div class="row d-flex justify-content-center">
                  <button class="btn btn-success btn-lg" style="width: 150px" onclick="event.preventDefault(); document.getElementById('newTicketForm').submit();">SPREMI</button>
               </div>
               

            </div> 
         </div>
         <div class="col">
            @livewire('tickets-table',[
               'theme' => 'bootstrap-5',
            ])  
         </div>
      </div>
      
      
   </div>
</div>
@endsection