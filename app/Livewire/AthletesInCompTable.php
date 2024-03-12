<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\AthleteInComp;

class AthletesInCompTable extends DataTableComponent
{
    //protected $model = AthleteInComp::class;
    public $compId;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(TRUE),
            Column::make("Ime", "getAthlete.firstName")
                ->sortable(),
            Column::make("Prezime", "getAthlete.lastName")
                ->sortable(),
            Column::make("Spol", "getAthlete.getGender.name")
                ->sortable(),
            Column::make("Adresa", "getAthlete.address")
                ->sortable(),
            Column::make("Grad", "getAthlete.city")
                ->sortable(),
            Column::make("Država", "getAthlete.state")
                ->sortable(),
            Column::make("Zip", "getAthlete.zip")
                ->sortable(),
            Column::make("Osobni broj", "getAthlete.athlete_id")
                ->sortable(),
        ];
    }

    public function builder(): Builder{
        return AthleteInComp::query()
            ->where('comp_id', $this->compId);
    }
}
