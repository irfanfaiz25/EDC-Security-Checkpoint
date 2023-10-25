<?php

namespace App\Livewire;

use App\Models\DataCheckpoint;
use App\Models\ScanHistory;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Dmc1Scan extends Component
{
    use WithPagination;

    public $searchCheckpoint;
    public $selectedPaginationUser = 5;

    // public $data = [];
    public $toastStatus;
    public $toastMessage;

    public $scanDmc1;

    // public function addToArray()
    // {
    //     $submissionData = [
    //         'input1' => $this->input1,
    //         'input2' => $this->input2
    //     ];

    //     $this->data[] = $submissionData;

    //     $this->input1 = '';
    //     $this->input2 = '';
    // }

    public function mount()
    {
        // $this->checkAndUpdateStatus();
    }

    public function scanCheckTime()
    {
        $currentTime = Carbon::now();

        $nightScanStart = Carbon::now()->setHour(19)->setMinute(0)->setSecond(0);
        $nightScanEnd = Carbon::now()->setHour(21)->setMinute(0)->setSecond(0);

        $morningScanStart = Carbon::now()->setHour(04)->setMinute(30)->setSecond(0);
        $morningScanEnd = Carbon::now()->setHour(05)->setMinute(30)->setSecond(0);

        if ($currentTime->between($nightScanStart, $nightScanEnd) || $currentTime->between($morningScanStart, $morningScanEnd)) {
            $scanRemark = 'Scanned';
        } else {
            $scanRemark = 'Scanned delayed';
        }

        return $scanRemark;
    }

    public function convertDate($date_string)
    {
        $date = Carbon::parse($date_string)->format('d-m-Y H:i');

        return $date;
    }

    function minutesToHours($minutes)
    {
        if ($minutes < 60) {
            return $minutes . ' menit';
        } else {
            $hours = floor($minutes / 60);
            $minuteRemainder = $minutes % 60;
            $hourStr = $hours . ' jam';
            $minuteStr = ($minuteRemainder > 0) ? ' ' . $minuteRemainder . ' menit' : '';

            return $hourStr . $minuteStr;
        }
    }

    // public function checkAndUpdateStatus()
    // {
    //     $checkpoints = DataCheckpoint::where('status', '!=', '')
    //         ->where('status', '<=', now()->setTimezone('Asia/Jakarta')->subMinutes(60))
    //         ->get();

    //     foreach ($checkpoints as $checkpoint) {
    //         $checkpoint->update([
    //             'status' => ''
    //         ]);
    //     }
    // }

    // public function checkAndUpdateStatus()
    // {
    //     $currentTime = Carbon::now();

    //     $startNightUpdate = Carbon::today()->setHour(18)->setMinute(58)->setSecond(0);
    //     $endNightUpdate = Carbon::today()->setHour(18)->setMinute(59)->setSecond(59);

    //     $startMoriningUpdate = Carbon::today()->setHour(3)->setMinute(58)->setSecond(0);
    //     $endMorningUpdate = Carbon::today()->setHour(3)->setMinute(59)->setSecond(59);

    //     if ($currentTime->between($startNightUpdate, $endNightUpdate, true) || $currentTime->between($startMoriningUpdate, $endMorningUpdate, true)) {
    //         $checkpoints = DataCheckpoint::where('status', '!=', '')
    //             ->where('lokasi_cp', 'dmc lt.1')
    //             ->get();

    //         foreach ($checkpoints as $checkpoint) {
    //             $checkpoint->update([
    //                 'status' => ''
    //             ]);
    //         }
    //     }
    // }

    // public function calculateCountdown($setTime)
    // {
    //     $set = Carbon::parse($setTime, 'Asia/Jakarta');
    //     $now = now()->setTimezone('Asia/Jakarta');

    //     $end = $now->diffInMinutes($set->addHours(1), false);
    //     $endInHours = $this->minutesToHours($end);

    //     return [
    //         'endInHours' => $endInHours,
    //         'endInt' => $end
    //     ];
    // }

    public function calculateCountdown()
    {
        // $set = Carbon::parse($setTime, 'Asia/Jakarta');
        $now = now()->setTimezone('Asia/Jakarta');
        $nextScan = Carbon::now()->setTime(19, 0, 0);

        $end = $now->diffInMinutes($nextScan, false);
        $endInHours = $this->minutesToHours($end);

        // $this->checkAndUpdateStatus();

        return [
            'endInHours' => $endInHours,
            'endInt' => $end
        ];
    }

    public function render()
    {
        return view('livewire.dmc1-scan', [
            'checkpoints' => DataCheckpoint::where('lokasi_cp', 'dmc lt.1')
                ->where('nama_cp', 'like', "%$this->searchCheckpoint%")
                ->paginate($this->selectedPaginationUser),
            'codes' => DataCheckpoint::where('lokasi_cp', 'dmc lt.1')->get()
        ]);
    }

    public function updatingSearchCheckpoint()
    {
        $this->gotoPage(1);
    }

    public function showToast($status, $message)
    {
        $this->toastStatus = $status;
        $this->toastMessage = $message;

        $this->dispatch('showSuccessToast');
    }

    public function scanCheckpoint()
    {
        $date_now = now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');

        $checkpoint = DataCheckpoint::where('nama_cp', $this->scanDmc1);
        $isCpNameFound = DataCheckpoint::where('nama_cp', $this->scanDmc1)
            ->where('lokasi_cp', 'dmc lt.1')
            ->exists();

        if ($isCpNameFound) {
            $timeCheck = $checkpoint->first()->status;
            $kodeScan = $checkpoint->first()->kode_cp;
            $namaScan = $checkpoint->first()->nama_cp;
            $remark = $this->scanCheckTime();
            $lokasiScan = $checkpoint->first()->lokasi_cp;
            $userScan = 'John';

            if (empty($timeCheck)) {
                $checkpoint->update([
                    'status' => $date_now
                ]);

                ScanHistory::create([
                    'kode_cp' => $kodeScan,
                    'nama_cp' => $namaScan,
                    'remark' => $remark,
                    'lokasi_cp' => $lokasiScan,
                    'user' => $userScan,
                ]);

                $this->showToast('success', "$this->scanDmc1 berhasil di scan !");

                $this->reset('scanDmc1');
            } else {
                $this->showToast('error', "$this->scanDmc1 sudah di scan !");

                $this->reset('scanDmc1');
            }

        } else {
            $this->showToast('error', "Barcode yang anda scan salah !");

            $this->reset('scanDmc1');
        }
    }
}