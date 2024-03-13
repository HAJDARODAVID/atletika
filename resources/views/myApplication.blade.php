@extends('layouts.appNew')

@section('content')
<div class="container">
  @guest
  <div class="row justify-content-center">
    Tu bude nekaj dok nisi prijavljeni
  </div>
  @endguest
  @auth
    <div class="row justify-content-center">
      <div class="col-md-6">
          <div class="card">
              <div class="card-header">
                <p class="h5"><b>Obrazac za prijavu natjecatelja[uređivanje]</b></p>
                <p class="h6"><b>Prijavnica: {{ $appForm->id }}</b></p>
                <p class="h6"><b>Natjecanje: {{ $appForm->getCompetitionInfo->name }}</b></p>
              </div>

              <div class="card-body d-flex justify-content-center">
                <div class="" style="width: 550px">

                  @livewire('application-form',[
                    'compId' => $appForm->comp_id,
                    'updateData' => $updateData,
                    'oldAppId' => $appForm->id,
                  ])
                </div>  
              </div>
          </div>
      </div>
    </div>
  @endauth
    
</div>
@endsection
