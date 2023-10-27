<div>
    <form wire:submit.prevent='loginSubmit'>
        <div class="d-flex justify-content-center mb-5">
            <img src="{{ asset('img/logo/logoo.png') }}" alt="logo-astra" height="50">
        </div>
        @if (session('invalid'))
            <div class="alert alert-danger alert-dismissible my-1 fade show" role="alert">
                <strong>Ups!</strong> {{ session('invalid') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row g-3 align-items-center justify-content-center">
            <div class="col-md-10">
                <input wire:model='username' id="username" type="text"
                    class="form-control border-2 border-primary @error('username')
                    is-invalid border-danger
                @enderror"
                    placeholder="Enter username">
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row g-3 align-items-center justify-content-center">
            <div class="col-md-10">
                <input wire:model='password' id="password" type="password"
                    class="form-control border-2 border-primary @error('password')
                    is-invalid border-danger
                @enderror"
                    placeholder="Enter password">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mt-4 d-flex justify-content-center">
            <div class="col-md-6 ms-0 text-center">
                <button class="btn btn-primary btn-login fw-medium">Login</button>
            </div>
        </div>
    </form>
</div>
