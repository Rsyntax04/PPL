                                                                        @extends('layouts.master')

@section('web-content')
<div class="d-flex justify-content-center align-items-center" style="height: 100vh; flex-direction: column;">
    <h1 class="text-center mb-3">Generate QR Code</h1>
    <p class="text-center mb-4">QR Code berlaku hingga: {{ $expiredAt->format('H:i:s') }}</p>
    <div style="text-align: center;">
        {!! $qrCode !!}
    </div>
</div>
@endsection
