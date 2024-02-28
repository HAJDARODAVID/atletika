@extends('layouts.admin')

@section('content')
<div class="container mt-3">
   <h5>Kategorije / discipline / godine</h5>
   <hr>
   <div class="container ml-5">
      <x-add-new-year-modal></x-add-new-year-modal>
      <x-add-new-discipline-modal></x-add-new-discipline-modal>
      <hr>
      <div class="d-flex justify-content-center">
         <div class="" style="width: 840px">
            @livewire('set-discipline-and-year',[
               'years' => $years,
               'disciplines' => $disciplines,
               'dsply' => $dsply,
            ])
         </div>
      </div>
      
      
   </div>
</div>
@endsection