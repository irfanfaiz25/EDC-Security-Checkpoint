@extends('layouts.main')

@section('content')
    @livewire('dmc2-scan')
@endsection

@push('script')
    <script>
        document.addEventListener('showSuccessToast', event => {
            $(document).ready(function() {
                $('.toast').toast('show');
            });
        });
    </script>
@endpush
