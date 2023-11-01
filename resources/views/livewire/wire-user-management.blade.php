<div>
    <div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="text-center">
                        <h3>Add User</h3>
                    </div>

                    <div class="mt-3">
                        <form wire:submit.prevent='addUser'>
                            <div class="form-floating mb-3">
                                <input wire:model='name' type="text"
                                    class="form-control rounded @error('name')
                                    is-invalid
                                @enderror"
                                    id="codeCheckpoint" placeholder="Enter name">
                                @error('name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <label for="codeCheckpoint">Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input wire:model='username' type="text"
                                    class="form-control rounded @error('username')
                                    is-invalid
                                @enderror"
                                    id="namaCheckpoint" placeholder="Enter username">
                                @error('username')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <label for="namaCheckpoint">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input wire:model='password' type="password"
                                    class="form-control rounded @error('password')
                                    is-invalid
                                @enderror"
                                    id="namaCheckpoint" placeholder="Enter password">
                                @error('password')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <label for="namaCheckpoint">Password</label>
                            </div>
                            @if (!$isDepartment)
                                <div class="form-floating mb-3">
                                    <select wire:model.change='department' type="text"
                                        class="form-select rounded @error('department')
                                    is-invalid
                                @enderror"
                                        id="department">
                                        <option selected value="">Pilih department</option>

                                        @foreach ($departmentsList as $department)
                                            <option value="{{ $department }}">{{ $department }}</option>
                                        @endforeach

                                        <option value="add-new">Others</option>

                                    </select>
                                    @error('department')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <label for="lokasiCheckpoint">Department</label>
                                </div>
                            @else
                                <div class="form-floating mb-3">
                                    <input wire:model='department' type="text"
                                        class="form-control rounded @error('department')
                                            is-invalid
                                        @enderror"
                                        id="department" placeholder="Enter department" autofocus>
                                    @error('department')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <label for="namaCheckpoint">Department</label>
                                    <span wire:click='setDepartmentFalse'
                                        class="fa fa-circle-xmark mt-3 pointer text-danger x-button"></span>
                                </div>
                            @endif
                            <div class="form-floating mb-3">
                                <input wire:model='foto' type="file"
                                    class="form-control rounded @error('foto')
                                            is-invalid
                                        @enderror"
                                    id="foto">
                                @error('foto')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <label for="namaCheckpoint">Image</label>
                            </div>

                            @if (session('successUser'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> {{ session('successUser') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('errorUser'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> {{ session('errorUser') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <button type="submit" class="float-end btn btn-outline-primary">Add User <i
                                        class="fa fa-circle-plus"></i></button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-md-8">
                @livewire('wire-user-table')
            </div>
        </div>

    </div>

</div>
