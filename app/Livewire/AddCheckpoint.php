<?php

namespace App\Livewire;

use App\Models\DataCheckpoint;
use Dflydev\DotAccessData\Data;
use Exception;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class AddCheckpoint extends Component
{
    use WithPagination;

    public $checkpointId;
    public $searchCheckpoint;

    public $checkpointCode;
    public $checkpointName;
    public $checkpointLocation;
    public $checkpointDesc;
    protected $rules_store = [
        'checkpointCode' => 'required|min:1|max:50|unique:data_checkpoints,kode_cp',
        'checkpointName' => 'required|min:2|max:50',
        'checkpointLocation' => 'required|min:2|max:50',
        'checkpointDesc' => 'required|min:5|max:100'
    ];

    public $checkpointCodeEdit;
    public $checkpointNameEdit;
    public $checkpointLocationEdit;
    public $checkpointDescEdit;
    protected $rules_edit = [
        // 'checkpointCodeEdit' => 'required|min:2|max:50|unique:data_checkpoints,kode_cp',
        'checkpointNameEdit' => 'required|min:2|max:50',
        'checkpointLocationEdit' => 'required|min:2|max:50',
        'checkpointDesc' => 'required|min:5|max:100'
    ];


    public function render()
    {
        return view('livewire.add-checkpoint', [
            'checkpoints' => DataCheckpoint::latest()
                ->where('nama_cp', 'like', "%{$this->searchCheckpoint}%")
                ->paginate(5)
        ]);
    }

    public function updatingSearchCheckpoint()
    {
        $this->gotoPage(1);
    }

    public function addCheckpoint()
    {
        $validated = $this->validate($this->rules_store);

        DataCheckpoint::create([
            'kode_cp' => $validated['checkpointCode'],
            'nama_cp' => $validated['checkpointName'],
            'desc_cp' => $validated['checkpointDesc'],
            'lokasi_cp' => $validated['checkpointLocation']
        ]);

        $this->reset('checkpointCode', 'checkpointName', 'checkpointDesc', 'checkpointLocation');

        session()->flash('cpSuccess', 'New checkpoint has been added.');

        $this->resetPage();
    }

    public function editCheckpoint(int $checkpointId)
    {
        $checkpoint = DataCheckpoint::find($checkpointId);

        if ($checkpoint) {
            $this->checkpointId = $checkpoint->id;
            $this->checkpointCodeEdit = $checkpoint->kode_cp;
            $this->checkpointNameEdit = $checkpoint->nama_cp;
            $this->checkpointDescEdit = $checkpoint->desc_cp;
            $this->checkpointLocationEdit = $checkpoint->lokasi_cp;
        } else {
            session()->flash('cpNotFound', 'Checkpoint tidak ditemukan !');
        }
    }

    public function updateCheckpoint()
    {
        $validated = $this->validate($this->rules_edit);

        DataCheckpoint::find($this->checkpointId)
            ->update([
                // 'kode_cp' => $validated['checkpointCodeEdit'],
                'nama_cp' => $validated['checkpointNameEdit'],
                'lokasi_cp' => $validated['checkpointLocationEdit'],
                'desc_cp' => $validated['checkpointDescEdit']
            ]);

        $this->reset('checkpointCodeEdit', 'checkpointNameEdit', 'checkpointDescEdit', 'checkpointLocationEdit');

        $this->dispatch('close-modal');

        session()->flash('cpSuccess', 'Chekpoint has been edited.');
    }

    public function deleteModalCheckpoint(int $checkpointId)
    {
        $this->checkpointId = $checkpointId;
    }

    public function destroyCheckpoint()
    {
        DataCheckpoint::find($this->checkpointId)->delete();

        $this->dispatch('close-modal');

        session()->flash('cpSuccess', 'Checkpoint has been deleted.');
    }

    public function closeModal()
    {
        $this->reset();
    }
}