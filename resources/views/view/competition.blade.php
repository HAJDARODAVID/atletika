@extends('layouts.admin')

@section('content')
<div class="container mt-3">
    <h5>Natjecanje: #{{ $competition->id }} - {{ $competition->name }}</h5>
    <hr>
    <div class="container ml-5">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="basic-info-tab" data-bs-toggle="tab" data-bs-target="#basic-info-tab-pane" type="button" role="tab" aria-controls="basic-info-tab-pane" aria-selected="true">Osnovno</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Prijavnice</button>
            </li>
            {{-- <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Contact</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false" disabled>Disabled</button>
            </li> --}}
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="basic-info-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <x-basic-competition-info :competition="$competition">
                </x-basic-competition-info>
            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <div class="container mt-3">
                    @livewire('application-form-table',[
                        'theme' => 'bootstrap-5',
                        'compId' => $competition->id,
                    ])
                </div>
            </div>
            {{-- <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
            <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div> --}}
          </div>
        
    </div>
</div>
@endsection