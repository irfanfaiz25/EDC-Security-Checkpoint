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
        // $(document).ready(function() {
        //     $('#uploadedImage').on('show.bs.modal', function(event) {
        //         // var image = $(event.relatedTarget).data('image');
        //         var image = $(this).data('image');
        //         $('#uploadedImage').attr('src', image);
        //         $('#cek1').val(image);
        //     });
        // });
        $(document).ready(function() {
            $(document).on('click', '#image-message', function() {
                let showImage = new bootstrap.Modal(document.getElementById(
                    'uploadedImage'), {});
                var image = $(this).data('image');

                $('#modalImage').attr('src', image);

                showImage.show();
            });
        });
    </script>
@endpush
