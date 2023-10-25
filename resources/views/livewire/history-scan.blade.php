<div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="input-group mb-1 mt-1">
                <input wire:model.live.debounce.200ms='searchHistory' type="text" class="form-control"
                    placeholder="Search history (Nama CP / PIC Check) ...">
                <span class="input-group-text bg-navy" id="basic-addon2">
                    <i class="fa fa-searchengin"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="row g-3 align-items-center mt-0">
        <div class="col-auto">
            <label for="select-paginate" class="col-form-label">Show</label>
        </div>
        <div class="col-auto">
            <select wire:model.live='selectedPagination' id="select-paginate" class="form-select form-select-sm">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="25">25</option>
            </select>
        </div>
    </div>

    <div class="table-responsive mt-1">
        <table class="table rounded-3 overflow-hidden align-middle">
            <thead>
                <tr>
                    <th class="table-navy text-center">
                        #
                    </th>
                    <th class="table-navy text-center">
                        Kode CP
                    </th>
                    <th class="table-navy text-center">
                        Nama CP
                    </th>
                    <th class="table-navy text-center">
                        Lokasi CP
                    </th>
                    <th class="table-navy text-center">
                        PIC Check
                    </th>
                    <th class="table-navy text-center">
                        Remark
                    </th>
                    <th class="table-navy text-center">
                        Timestamp
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($histories as $value => $history)
                    <tr>
                        <td class="text-center">
                            {{ $value + $histories->firstItem() }}
                        </td>
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
                            {{ $history->user }}
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
                            {{ $history->created_at->format('d-m-Y H:i') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-1">
            {{ $histories->links() }}
        </div>

    </div>
</div>
