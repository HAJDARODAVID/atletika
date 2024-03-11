<?php

namespace App\Livewire;

use App\Models\Competition;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class CompetitionsTable extends DataTableComponent
{
    //protected $model = Competition::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchBlur();
        $this->setTableRowUrl(function($row) {
            return route('competition', $row->id);
            });
        $this->setFilter('status', '1');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->sortable(),
            Column::make("Naziv natjecanja", "name")
                ->sortable()
                ->searchable(),
            Column::make("Organizator", "organizer")
                ->sortable(),
            Column::make("Mjesto", "place")
                ->sortable(),
            Column::make("Napomena", "remark")
                ->sortable(),
            Column::make("From", "from")
                ->sortable(),
            Column::make("To", "to")
                ->sortable(),
            Column::make("Status", "status")
                ->sortable(),
            Column::make('Actions')
                ->label(
                    fn($row, Column $column) => view('table-actions.competitions-table-actions')->withRow($row)
                )
                ->unclickable(),
        ];
    }

    public function builder(): Builder{
        return Competition::query()
            ->where('status', '!=', -1)
            ->orderBy('id', 'desc');
    }

    public function filters(): array{
        return [
        SelectFilter::make('Status', 'status')
            ->options(Competition::COMP_STATUS)
            ->filter(function(Builder $builder, string $value) {
                $builder->where('status', $value);
            }),
        ];
    }
}
