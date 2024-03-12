@extends('layouts.admin')

@section('content')
<div class="container">

team_name => {{ $appForm->team_name }} <br>
year => {{ $appForm->year }} <br>
category => {{ $appForm->category }} <br>
<b>Athlete in comp:</b><br>
{{-- {{ dd($appForm->getAthletesFromApplication) }}  --}}
@foreach ($appForm->getAthletesFromApplication as $athlete)
- athelet => {{ $athlete->getAthlete->firstName }} {{ $athlete->getAthlete->lastName }} <br>
    @foreach ($athlete->getDisciplines as $dspl)
        - - {{ $dspl->getDisciplineInfo->name }} <br>
    @endforeach     
@endforeach
</div>
@endsection
