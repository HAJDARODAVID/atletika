<?php

namespace App\Livewire;

use App\Models\ApplicationForm;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class ApplicationFormTable extends DataTableComponent
{
    //protected $model = ApplicationForm::class;
    public $compId = NULL;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableRowUrl(function($row) {
            return route('showApplicationAdm', $row->id);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->sortable(),
            Column::make("User id", "user_id")
                ->hideIf(TRUE),
            Column::make("Comp id", "comp_id")
                ->hideIf(TRUE),
            Column::make("Naziv ekipe", "team_name")
                ->sortable()
                ->searchable(),
            Column::make("Godina", "year")
                ->sortable(),
            Column::make("Kategorija", "category")
                ->sortable(),
        ];
    }

    public function builder(): Builder{
        if(!$this->compId){
            return ApplicationForm::query()
            ->orderBy('id', 'desc');
        }

        if($this->compId){
            return ApplicationForm::query()
            ->where('comp_id', $this->compId)
            ->orderBy('id', 'desc');
        }
        
    }
}
