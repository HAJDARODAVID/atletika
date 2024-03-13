<?php

namespace App\Livewire;

use App\Models\ApplicationForm;
use App\Models\Competition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class MyApplicationsTable extends DataTableComponent
{
    protected $model = ApplicationForm::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableRowUrl(function($row) {
            return route('showMyApplication', $row->id);
            });
        $this->setSearchDisabled();
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->hideIf(TRUE),
            Column::make("Ekipa", "team_name")
                ->sortable(),
            Column::make("Natjecanje", "getCompetitionInfo.name")
                ->sortable(),
            Column::make("Year", "year")
                ->sortable(),
            Column::make("Category", "getCategory.name")
                ->sortable(),
            Column::make("Datum natjecanja", "getCompetitionInfo.event_date")
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        return ApplicationForm::query()
            ->where('user_id', Auth::user()->id)
            ->where('getCompetitionInfo.status', Competition::COMP_STATUS_ACTIVE);
    }
}
