@extends('layouts.main')

@section('content')
    @livewire('add-checkpoint')
@endsection

@push('script')
    <script>
        document.addEventListener('close-modal', event => {
            $('#editCheckpointModal').modal('hide');
            $('#deleteConfirmationCpModal').modal('hide');
        });
    </script>
@endpush
