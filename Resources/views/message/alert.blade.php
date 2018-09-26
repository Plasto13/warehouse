@push('css-stack')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
@endpush



@push('js-stack')
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
@if (alert()->ready())
    <script>
        swal({
            title: "{!! alert()->message() !!}",
            text: "{!! alert()->option('text') !!}",
            type: "{!! alert()->type() !!}",
            @if(alert()->option('timer'))
                timer: {!! alert()->option('timer') !!},
                @if(alert()->option('showConfirmButton') == true)
                showConfirmButton: true,
                @endif
            @endif
        }).done();;
    </script>
@endif
@endpush