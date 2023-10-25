        @if ($toastStatus == 'success')
            <div aria-live="polite" aria-atomic="true" class="position-relative">
                <div class="toast-container toast-office1 end-0 p-3">
                    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-success text-white">
                            {{-- <img src="..." class="rounded me-2" alt="..."> --}}
                            <strong class="me-auto">{{ $toastStatus }}</strong>
                            <small class="text-body-white">just now</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            {{ $toastMessage }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($toastStatus == 'error')
            <div aria-live="polite" aria-atomic="true" class="position-relative">
                <div class="toast-container toast-office1 end-0 p-3">
                    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-danger text-white">
                            <strong class="me-auto">{{ $toastStatus }}</strong>
                            <small class="text-body-white">just now</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            {{ $toastMessage }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
