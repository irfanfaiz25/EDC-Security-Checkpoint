@extends('layouts.main')

@section('content')
    @livewire('wire-dashboard')
@endsection

@push('script')
    <script>
        const time = document.querySelector(".hour"),
            second = document.querySelector(".second"),
            month = document.querySelector(".month"),
            day = document.querySelector(".day");

        let monthData = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ];

        setInterval(() => {
            let date = new Date();
            var hours = date.getHours().toString().padStart(2, '0');
            var minutes = date.getMinutes().toString().padStart(2, '0');
            var seconds = date.getSeconds().toString().padStart(2, '0');

            time.innerText = hours + ":" + minutes + ":" + seconds;

            let monthMath = date.getMonth();

            month.innerText = monthData[monthMath];
            day.innerText = date.getDate();
        });
    </script>
@endpush
