@extends('layouts.appNew')

@section('content')
<div  >
  @guest
  <div class="row justify-content-center">
      Tu ide nekaj dok nisi prijavljeni
  </div>
  @endguest

  @auth
  <div class="row justify-content-center mb-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
              <p class="h5"><b>Popis aktivnih natjecanja</b></p>
            </div>

            <div class="card-body d-flex justify-content-center">
              <div class="" style="width: 750px">

                @livewire('competitions-for-application-table',[
                  'theme' => 'bootstrap-5',
                ])
              </div>  
            </div>
        </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
              <p class="h5"><b>Moje prijavnice:</b></p>
            </div>

            <div class="card-body d-flex justify-content-center">
              <div class="" style="width: 750px">

                @livewire('my-applications-table',[
                  'theme' => 'bootstrap-5',
                ])
              </div>  
            </div>
        </div>
    </div>
  </div>
  @endauth
    
</div>
@endsection
