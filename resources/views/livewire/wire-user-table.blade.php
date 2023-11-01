<div class="card">

    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="input-group mb-1 mt-1">
                <input wire:model.live.debounce.200ms='searchUsers' type="text" class="form-control"
                    placeholder="Search users ...">
                <span class="input-group-text bg-navy" id="basic-addon2">
                    <i class="fa fa-searchengin"></i>
                </span>
            </div>
        </div>
    </div>

    @if (session('successUser'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('successUser') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('errorUser'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('errorUser') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="table-responsive">
        <table class="table rounded-3 overflow-hidden text-center align-middle mt-4">
            <thead>
                <tr>
                    <th class="text-center bg-navy" scope="col">
                        #
                    </th>
                    <th class="text-center bg-navy" scope="col">
                        Image
                    </th>
                    <th class="text-center bg-navy" scope="col">
                        Nama
                    </th>
                    <th class="text-center bg-navy" scope="col">
                        Username
                    </th>
                    @if ($isEdit)
                        <th class="text-center bg-navy" scope="col">
                            Password
                        </th>
                    @endif
                    <th class="text-center bg-navy" scope="col">
                        Department
                    </th>
                    <th class="text-center bg-navy" scope="col">

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $value => $user)
                    <tr class="align-middle">
                        <td class="text-center align-middle">
                            {{ $value + $users->firstItem() }}
                        </td>
                        <td class="text-center">
                            @if ($userId === $user->id)
                                <div class="d-flex">
                                    @if ($foto && !is_string($foto))
                                        <img class="img-table" src="{{ $foto->temporaryUrl() }}" alt="img-user">
                                    @else
                                        @if (!empty($user->foto))
                                            <img class="img-table"
                                                src="{{ asset('storage/img/user-image/' . $user->foto) }}"
                                                alt="img-user">
                                        @else
                                            <img class="img-table" src="{{ asset('img/logo/user.png') }}"
                                                alt="img-user">
                                        @endif
                                    @endif

                                    <label for="fileInput" class="custom-button-edit mt-2">
                                        <i class="fa fa-pencil text-success"></i>
                                    </label>
                                    <input wire:model='foto' type="file" id="fileInput" accept="image/*">
                                </div>
                            @else
                                <div class="d-flex">
                                    @if (!empty($user->foto))
                                        <img class="img-table"
                                            src="{{ asset('storage/img/user-image/' . $user->foto) }}" alt="img-user">
                                    @else
                                        <img class="img-table" src="{{ asset('img/logo/user.png') }}" alt="img-user">
                                    @endif
                                </div>
                            @endif
                            @error('foto')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </td>
                        <td class="text-center align-middle">
                            @if ($userId === $user->id)
                                <input wire:model='name' type="text"
                                    class="form-control form-control-sm @error('name') is-invalid @enderror"
                                    value="{{ $user->name }}">
                                @error('name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            @else
                                {{ $user->name }}
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            @if ($userId === $user->id)
                                <input wire:model='username' type="text"
                                    class="form-control form-control-sm @error('username') is-invalid @enderror"
                                    value="{{ $user->username }}">
                                @error('username')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            @else
                                {{ $user->username }}
                            @endif
                        </td>
                        @if ($userId === $user->id && $isChangePassword)
                            <td class="text-center align-middle">
                                <div class="d-flex">
                                    <input wire:model='password' type="password"
                                        class="form-control form-control-sm @error('password') is-invalid @enderror"
                                        placeholder="New password">
                                    <i wire:click='setChangePasswordFalse'
                                        class="fa fa-circle-xmark text-danger m-2 pointer"></i>
                                </div>
                                @error('password')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </td>
                        @elseif ($userId === $user->id && !$isChangePassword)
                            <td class="text-center align-middle">
                                <span wire:click='setChangePasswordTrue' class="text-navy pointer">
                                    change
                                </span>
                            </td>
                        @endif
                        <td class="text-center align-middle">
                            @if ($userId === $user->id)
                                @if (!$isDepartmentEdit)
                                    <div>
                                        <select wire:model.change='department' type="text"
                                            class="form-select form-select-sm @error('department')
                                    is-invalid
                                @enderror"
                                            id="department">
                                            <option selected value="">Pilih department
                                            </option>

                                            @foreach ($departmentsList as $department)
                                                <option value="{{ $department }}">
                                                    {{ $department }}</option>
                                            @endforeach

                                            <option value="add-new">Others</option>

                                        </select>
                                        @error('department')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @else
                                    <div>
                                        <input wire:model='department' type="text"
                                            class="form-control form-control-sm rounded @error('department')
                                            is-invalid
                                        @enderror"
                                            id="department" placeholder="Enter department" autofocus>
                                        @error('department')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        <span wire:click='setDepartmentEditFalse'
                                            class="fa fa-circle-xmark mt-3 pointer text-danger x-edit-button"></span>
                                    </div>
                                @endif
                            @else
                                {{ $user->department }}
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            @if ($userId === $user->id)
                                <div class="d-flex">
                                    <button wire:click='updateUser' class="btn bg-navy btn-sm">Save</button>
                                    <i wire:click='cancelEdit' class="fa fa-circle-xmark text-danger m-2 pointer"></i>
                                </div>
                            @else
                                <i wire:click='setEdit({{ $user->id }})'
                                    class="fa fa-pencil text-success pointer mx-1"></i>
                                <i wire:click='deleteUser({{ $user->id }})'
                                    class="fa fa-trash text-danger pointer mx-1"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>

</div>
