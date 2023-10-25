<div>

    @include('components.toast-notification')

    <div class="row">
        <div wire:poll.keep-alive.60s class="px-4 mb-4">

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group mb-1 float-end">
                        <input wire:model.live.debounce.200ms='searchCheckpoint' type="text" class="form-control"
                            placeholder="Search checkpoint ...">
                        <span class="input-group-text bg-navy" id="basic-addon2">
                            <i class="fa fa-searchengin"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="row g-3 align-items-center mt-0">
                <div class="col-md-2 d-flex justify-content-start">
                    <label for="select-paginate" class="col-form-label me-1">Show</label>
                    <select wire:model.live='selectedPaginationUser' id="select-paginate" class="form-select">
                        <option value="3">3</option>
                        <option value="5" selected>5</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>

            <table class="table rounded-3 overflow-hidden">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center align-middle bg-navy">
                            Kode
                        </th>
                        <th class="text-center align-middle bg-navy">
                            Nama
                        </th>
                        <th class="text-center align-middle bg-navy">
                            Checkpoint Desc
                        </th>
                        <th class="text-center align-middle bg-navy">
                            Status
                        </th>
                        <th class="text-center align-middle bg-navy">
                            Scan berikutnya
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($checkpoints as $checkpoint)
                        <tr>
                            <td class="text-center align-middle">
                                {{ $checkpoint->kode_cp }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $checkpoint->nama_cp }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $checkpoint->desc_cp }}
                            </td>
                            <td class="text-center align-middle">
                                @if (empty($checkpoint->status))
                                    <div class="badge bg-danger">
                                        not scanned
                                    </div>
                                @else
                                    <div class="badge bg-success">
                                        {{ $this->convertDate($checkpoint->status) }}
                                    </div>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                @php
                                    $resultEndInt = $this->calculateCountdown($checkpoint->status);
                                    $endInt = $resultEndInt['endInt'];
                                @endphp
                                @if (!empty($checkpoint->status) && $endInt >= 0)
                                    <span class="text-success fw-medium">
                                        @php
                                            $resultEndTime = $this->calculateCountdown($checkpoint->status);
                                            $endTime = $resultEndTime['endInHours'];
                                            echo $endTime;
                                        @endphp
                                    </span>
                                @else
                                    <span class="text-danger fw-medium">
                                        Delayed scan
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $checkpoints->links() }}
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-title">
                    Scan Office Lt.1
                </div>
                <div wire:submit.prevent='scanCheckpoint' class="card-body">
                    <form action="">
                        <label for="scan-office" class="form-label">
                            Scan office checkpoint
                        </label>
                        <input wire:model='scanOutdoor' type="password" class="form-control form-control-sm"
                            id="scan-office" placeholder="Scan the barcode ..." autofocus>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="image-container">
                <img src="{{ asset('img/checkpoint/outdoor.png') }}" alt="Image"
                    class="image-checkpoint image-rotate">
                @foreach ($codes as $code)
                    <div
                        class="
                    @if (empty($code->status)) marker
                        @else
                        marker-done @endif marker-{{ $code->kode_cp }} blink">
                        <span class="loc-id">{{ $code->kode_cp }}</span>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</div>
