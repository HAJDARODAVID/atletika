<?php

namespace App\Livewire;

use App\Models\Competition;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class CompetitionsForApplicationTable extends DataTableComponent
{
    //protected $model = Competition::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchBlur();
        $this->setTableRowUrl(function($row) {
            return route('application', $row->id);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->hideIf(TRUE),
            Column::make("Naziv natjecanja", "name")
                ->sortable()
                ->searchable(),
            Column::make("Organizator", "organizer")
                ->sortable(),
            Column::make("Mjesto", "place")
                ->sortable(),
            Column::make("Napomena", "remark")
                ->sortable(),
            Column::make("Od", "from")
                ->sortable(),
            Column::make("Do", "to")
                ->sortable(),
            Column::make("Status", "status")
                ->hideIf(TRUE),
        ];
    }

    public function builder(): Builder{
        return Competition::query()
            ->where('status', 1)
            ->orderBy('id', 'desc');
    }
}
