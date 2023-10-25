<div>

    <div class="row">
        <div class="col-md-5 mt-0">
            <div class="row">

                <div class="col-md-12">
                    <div class="clockku justify-content-center">
                        <div class="container-clock">
                            <div class="time">
                                <h1 class="hour mt-2"></h1>
                            </div>
                            <div class="days mt-4">
                                <ul>
                                    <li class="month">🫣</li>
                                    <li class="day">🫣</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-4">
                    <div class="card">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-money color-success border-success"></i>
                            </div>
                            <div class="stat-content dib">
                                <div class="stat-text">Total Profit</div>
                                <div class="stat-digit">1,012</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="card">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-user color-primary border-primary"></i>
                            </div>
                            <div class="stat-content dib">
                                <div class="stat-text">New Customer</div>
                                <div class="stat-digit">961</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-layout-grid2 color-pink border-pink"></i>
                            </div>
                            <div class="stat-content dib">
                                <div class="stat-text">Active Projects</div>
                                <div class="stat-digit">770</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-link color-danger border-danger"></i>
                            </div>
                            <div class="stat-content dib">
                                <div class="stat-text">Referral</div>
                                <div class="stat-digit">2,781</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-7">

            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="input-group mt-1">
                        <input wire:model.live.debounce.200ms='searchTable' type="text" class="form-control"
                            placeholder="Search (Nama CP / PIC Check) ...">
                        <span class="input-group-text bg-navy" id="basic-addon2">
                            <i class="fa fa-searchengin"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="row g-3 align-items-center mt-0 mb-3 d-flex">
                <div class="col-auto d-flex">
                    <label for="select-time" class="col-form-label me-1">Lokasi</label>
                    <select wire:model.live='searchLocation' id="input-time" class="form-select form-select-sm">
                        <option value="office lt.1">Office Lantai 1</option>
                        <option value="office lt.2">Office Lantai 2</option>
                        <option value="dmc lt.1">DMC Lantai 1</option>
                        <option value="dmc lt.2">DMC Lantai 2</option>
                        <option value="outdoor">Outdoor</option>
                    </select>
                </div>
                <div class="col-auto d-flex">
                    <label for="select-date" class="col-form-label me-1">Tanggal</label>
                    <input wire:model.live='searchDate' type="date" id="select-date"
                        class="form-control form-control-sm">
                </div>
                <div class="col-auto d-flex">
                    <label for="select-time" class="col-form-label me-1">Jam</label>
                    <input wire:model.live='searchStartTime' type="time" id="input-time"
                        class="form-control form-control-sm">
                    <span class="mx-1 mt-2 fw-medium">
                        -
                    </span>
                    <input wire:model.live='searchEndTime' type="time" id="input-time"
                        class="form-control form-control-sm">
                </div>
            </div>

            <div class="table-responisve">
                <table wire:poll.keep-alive.60s class="table rounded-3 overflow-hidden">
                    <thead>
                        <th class="text-center align-middle bg-navy">
                            Kode CP
                        </th>
                        <th class="text-center align-middle bg-navy">
                            Nama CP
                        </th>
                        <th class="text-center align-middle bg-navy">
                            Lokasi CP
                        </th>
                        <th class="text-center align-middle bg-navy">
                            Remark
                        </th>
                        <th class="text-center align-middle bg-navy">
                            PIC Check
                        </th>
                        <th class="text-center align-middle bg-navy">
                            Timestamp
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($histories as $history)
                            <tr>
                                <td class="text-center">
                                    {{ $history->kode_cp }}
                                </td>
                                <td class="text-center">
                                    {{ $history->nama_cp }}
                                </td>
                                <td class="text-center">
                                    {{ $history->lokasi_cp }}
                                </td>
                                <td class="text-center">
                                    @if ($history->remark == 'Scanned')
                                        <span class="text-success fw-medium">
                                            {{ $history->remark }}
                                        </span>
                                    @else
                                        <span class="text-danger fw-medium">
                                            {{ $history->remark }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ $history->user }}
                                </td>
                                <td class="text-center">
                                    {{ $history->created_at }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $histories->links() }}

            </div>
        </div>
    </div>

</div>
