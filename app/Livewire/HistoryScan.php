<?php

namespace App\Livewire;

use App\Models\ScanHistory;
use Livewire\Component;
use Livewire\WithPagination;

class HistoryScan extends Component
{
    use WithPagination;

    public $searchHistory;
    public $selectedPagination = 10;
    public function render()
    {
        return view('livewire.history-scan', [
            'histories' => ScanHistory::latest()
                ->where('nama_cp', 'like', "%$this->searchHistory%")
                ->orWhere('user', 'like', "%$this->searchHistory%")
                ->paginate($this->selectedPagination)
        ]);
    }
}