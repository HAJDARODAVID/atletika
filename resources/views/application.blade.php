@extends('layouts.appNew')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                  <p class="h5"><b>Obrazac za prijavu natjecatelja</b></p>
                </div>

                <div class="card-body d-flex justify-content-center">
                  <div class="" style="width: 450px">
                    
                    @livewire('application-form')
                  </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
