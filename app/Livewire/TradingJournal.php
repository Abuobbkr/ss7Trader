<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Trade;

class TradingJournal extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'entry_date';
    public $sortDirection = 'desc';

    // Resets pagination whenever the search query changes
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Toggles the sort direction
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function render()
    {
        $trades = Trade::query()
            ->when($this->search, function ($query) {
                $query->where('coin', 'like', '%' . $this->search . '%')
                      ->orWhere('profit_loss', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10); // Adjust number of items per page here

        return view('livewire.trading-journal', [
            'trades' => $trades,
        ]);
    }
}