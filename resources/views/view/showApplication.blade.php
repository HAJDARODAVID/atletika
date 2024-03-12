@extends('layouts.admin')

@section('content')
    <div class="container mt-3">
        <h5>Ekipa: {{ $appForm->team_name }}</h5>
        <h6>Natjecanje: {{ $appForm->getCompetitionInfo->name }}</h6>
        <hr>
        <div class="container ml-5" style="width: 750px">
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <h6>Godište: {{ $appForm->year }}</h6>  
                </div>
                <div class="col d-flex justify-content-center">
                    <h6>Kategorija: {{ $appForm->category }}</h6>  
                </div>
            </div>
            <hr>
            <div class="row d-flex justify-content-center">
                <h6 class="d-flex justify-content-center">Prijavljni natjecatelji:<h6>
            </div>
            <hr class="my-0 mb-2">
            
            @php 
                $newRow=1;
                $colCount=0;
                $string= '';

                foreach($appForm->getAthletesFromApplication as $athlete){
                    if($newRow==1){
                        $string .= "<div class='row'>";
                        $newRow=0;
                    }

                    $string .= "<div class='col'>";
                    $string .= "<b>".$athlete->getAthlete->firstName." ".$athlete->getAthlete->lastName."</b><br>";
                    foreach ($athlete->getDisciplines as $dspl) {
                        $string .= " - ".$dspl->getDisciplineInfo->name."<br>";
                    }
                    $string .= "</div>";
                    $colCount++;

                    if($colCount == 2){
                        $newRow=2;
                    }

                    if($newRow==2){
                        $string .= "</div>";
                        $newRow=1;
                    }
                }
            @endphp

            {!! $string !!}

        </div>

        
    </div>
@endsection
