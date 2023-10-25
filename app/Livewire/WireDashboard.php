<?php

namespace App\Livewire;

use App\Models\DataCheckpoint;
use App\Models\ScanHistory;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class WireDashboard extends Component
{
    use WithPagination;

    public $searchLocation = 'office lt.1';
    public $searchStartTime = '00:00';
    public $searchEndTime = '23:59';
    public $searchDate;
    public $searchTable;


    public function __construct()
    {
        $this->searchDate = Carbon::now()->toDateString();
    }

    public function render()
    {
        return view('livewire.wire-dashboard', [
            'histories' => DataCheckpoint::leftJoin('scan_histories', function ($join) {
                $join->on('data_checkpoints.kode_cp', '=', 'scan_histories.kode_cp')
                    ->whereDate('scan_histories.created_at', '=', $this->searchDate)
                    ->whereTime('scan_histories.created_at', '>=', "$this->searchStartTime")
                    ->whereTime('scan_histories.created_at', '<=', "$this->searchEndTime");
            })
                ->where('data_checkpoints.lokasi_cp', "$this->searchLocation")
                ->where(function ($query) {
                    $query->orWhere('data_checkpoints.kode_cp', 'like', '%' . $this->searchTable . '%')
                        ->orWhere('data_checkpoints.nama_cp', 'like', '%' . $this->searchTable . '%');
                })
                ->select('data_checkpoints.kode_cp', 'data_checkpoints.nama_cp', 'data_checkpoints.lokasi_cp', 'scan_histories.remark', 'scan_histories.user', 'scan_histories.created_at')
                ->paginate(5)
        ]);
    }
}