@extends('layouts.admin')

@section('content')
<div class="container mt-3">
    <h5>Natjecanja</h5>
    <hr>
    <div class="container ml-5">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @livewire('create-new-competition-modal')

        <hr>
        @livewire('competitions-table',[
            'theme' => 'bootstrap-5',
        ])
    </div>
</div>
@endsection