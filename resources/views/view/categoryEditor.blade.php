@extends('layouts.admin')

@section('content')
<div class="container mt-3">
   <h5>Kategorije / discipline / godine</h5>
   <hr>
   <div class="container ml-5">
      <button class="btn btn-success "><i class="bi bi-plus-circle"></i> GODINE</button>
      <button class="btn btn-success "><i class="bi bi-plus-circle"></i> DISCIPLINE</button>
      <hr>
      @livewire('set-discipline-and-year',[
         'years' => $years,
         'disciplines' => $disciplines,
      ])
   </div>
</div>
@endsection