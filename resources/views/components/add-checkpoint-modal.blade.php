<!-- Edit Checkpoint Modal -->
<div wire:ignore.self class="modal fade" id="editCheckpointModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Checkpoint</h1>
                <button wire:click='closeModal' type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='updateCheckpoint' action="">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="kodeCpEdit" class="col-form-label">Kode Checkpoint</label>
                        </div>
                        <div class="col-md-8">
                            <input wire:model='checkpointCodeEdit' type="text" id="kodeCpEdit"
                                class="form-control @error('checkpointCodeEdit')
                                is-invalid
                            @enderror">
                            @error('checkpointCodeEdit')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="namaCpEdit" class="col-form-label">Nama Checkpoint</label>
                        </div>
                        <div class="col-md-8">
                            <input wire:model='checkpointNameEdit' type="text" id="namaCpEdit"
                                class="form-control @error('checkpointNameEdit')
                                is-invalid
                            @enderror">
                            @error('checkpointNameEdit')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="descCpEdit" class="col-form-label">Checkpoint Description</label>
                        </div>
                        <div class="col-md-8">
                            <input wire:model='checkpointDescEdit' type="text" id="descCpEdit"
                                class="form-control @error('checkpointDescEdit')
                                is-invalid
                            @enderror">
                            @error('checkpointDescEdit')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="lokasiCp" class="col-form-label">Lokasi Checkpoint</label>
                        </div>
                        <div class="col-md-8">
                            <select wire:model='checkpointLocationEdit' type="text"
                                class="form-select rounded @error('checkpointLocationEdit')
                                is-invalid
                            @enderror"
                                id="lokasiCp" placeholder="Lokasi checkpoint">
                                <option value="office lt.1" @if ($checkpointLocationEdit == 'office lt.1') selected @endif>Office
                                    Lantai 1</option>
                                <option value="office lt.2" @if ($checkpointLocationEdit == 'office lt.2') selected @endif>Office
                                    Lantai 2</option>
                                <option value="dmc lt.1" @if ($checkpointLocationEdit == 'dmc lt.1') selected @endif>DMC Lantai 1
                                </option>
                                <option value="dmc lt.2" @if ($checkpointLocationEdit == 'dmc lt.2') selected @endif>DMC Lantai 2
                                </option>
                                <option value="outdoor" @if ($checkpointLocationEdit == 'outdoor') selected @endif>Outdoor
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row float-end">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-sm mt-1">Save <i
                                    class="fa fa-floppy-disk"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- end edit checkpoint modal --}}

{{-- delete confirmation checkpoint modal --}}
<div wire:ignore.self id="deleteConfirmationCpModal" class="modal fade" tabindex=" -1">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header ">
                <button wire:click='closeModal' type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="icon-box">
                    <i class="fa fa-xmark fa-xl"></i>
                </div>
                <h4 class="modal-title mb-2">Are you sure?</h4>
                <p>Do you really want to delete these records? This process cannot be undone.</p>

                <div class="mt-5">
                    <button wire:click='closeModal' type="button" class="btn btn-info"
                        data-bs-dismiss="modal">Cancel</button>
                    <button wire:click='destroyCheckpoint' type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end delete confirmation checkpoint modal --}}
