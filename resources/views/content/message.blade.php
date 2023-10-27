@extends('layouts.main')

@section('content')
    @livewire('wire-message')
@endsection

@push('script')
    <script>
        (function($) {
            $(window).on("load", function() {
                $(".content").mCustomScrollbar();
            });
        })(jQuery);
    </script>
@endpush
