<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;

class TicketsTable extends DataTableComponent
{
    protected $model = Ticket::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Body", "body")
                ->sortable(),
            Column::make("Priority", "priority")
                ->sortable(),
            Column::make("Status", "status")
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        return Ticket::query()
            ->where('status', '!=', Ticket::TICKET_STATUS_CANCELED);
    }
}
