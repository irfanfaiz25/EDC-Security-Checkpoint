<div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="text-center">
                    <h3>Add Checkpoint</h3>
                </div>

                <div class="mt-4">
                    <form wire:submit.prevent='addCheckpoint' action="">
                        <div class="form-floating mb-3">
                            <input wire:model='checkpointCode' type="text"
                                class="form-control rounded @error('checkpointCode')
                                is-invalid
                            @enderror"
                                id="codeCheckpoint" placeholder="Nama checkpoint">
                            @error('checkpointCode')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                            <label for="codeCheckpoint">Kode Checkpoint</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input wire:model='checkpointName' type="text"
                                class="form-control rounded @error('checkpointName')
                                is-invalid
                            @enderror"
                                id="namaCheckpoint" placeholder="Nama checkpoint">
                            @error('checkpointName')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                            <label for="namaCheckpoint">Nama Checkpoint</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input wire:model='checkpointDesc' type="text"
                                class="form-control rounded @error('checkpointDesc')
                                is-invalid
                            @enderror"
                                id="namaCheckpoint" placeholder="Checkpoint Description">
                            @error('checkpointDesc')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                            <label for="namaCheckpoint">Checkpoint Description</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select wire:model='checkpointLocation' type="text"
                                class="form-select rounded @error('checkpointLocation')
                                is-invalid
                            @enderror"
                                id="lokasiCheckpoint" placeholder="Lokasi checkpoint">
                                <option selected value="">Pilih lokasi</option>
                                <option value="office lt.1">Office Lantai 1</option>
                                <option value="office lt.2">Office Lantai 2</option>
                                <option value="dmc lt.1">DMC Lantai 1</option>
                                <option value="dmc lt.2">DMC Lantai 2</option>
                                <option value="outdoor">Outdoor</option>
                            </select>
                            @error('checkpointLocation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <label for="lokasiCheckpoint">Lokasi Checkpoint</label>
                        </div>
                        <div class="col-md-12">
                            <button class="float-end btn btn-outline-success">Add Checkpoint <i
                                    class="fa fa-circle-plus"></i></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="text-center">
                    <h3>Data Checkpoint</h3>
                </div>

                <div class="col-md-12">
                    <div class="float-end">
                        <div class="input-group mb-3">
                            <input wire:model.live.debounce.200ms='searchCheckpoint' type="text"
                                class="form-control form-control-sm rounded-start" placeholder="Search ...">
                            <span class="input-group-text bg-navy" id="basic-addon2"><i
                                    class="fa fa-searchengin"></i></span>
                        </div>
                    </div>
                </div>

                @if (session('cpSuccess'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('cpSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


                <div class="table">
                    <table class="table text-center align-middle mt-4">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">
                                    #
                                </th>
                                <th class="text-center" scope="col">
                                    Kode CP
                                </th>
                                <th class="text-center" scope="col">
                                    Nama CP
                                </th>
                                <th class="text-center" scope="col">
                                    CP Desc
                                </th>
                                <th class="text-center" scope="col">
                                    Lokasi CP
                                </th>
                                <th class="text-center" scope="col">

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($checkpoints as $value => $checkpoint)
                                <tr>
                                    <td class="text-center">
                                        {{ $value + $checkpoints->firstItem() }}
                                    </td>
                                    <td class="text-center">
                                        {{ $checkpoint->kode_cp }}
                                    </td>
                                    <td class="text-center">
                                        {{ $checkpoint->nama_cp }}
                                    </td>
                                    <td class="text-center">
                                        {{ $checkpoint->desc_cp }}
                                    </td>
                                    <td class="text-center text-uppercase">
                                        {{ $checkpoint->lokasi_cp }}
                                    </td>
                                    <td class="text-center">
                                        <a wire:click='editCheckpoint({{ $checkpoint->id }})'
                                            class="badge badge-warning" data-bs-toggle="modal"
                                            data-bs-target="#editCheckpointModal">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a wire:click='deleteModalCheckpoint({{ $checkpoint->id }})'
                                            class="badge badge-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteConfirmationCpModal">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $checkpoints->links() }}
                </div>

                @include('components.add-checkpoint-modal')

            </div>
        </div>
    </div>

</div>
