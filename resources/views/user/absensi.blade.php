@extends('layouts.user')

@section('title', 'Absensi')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 py-10">

    {{-- Card yang berisi judul dan scanner --}}
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-md border border-gray-200">
        <h1 class="text-2xl font-semibold text-gray-800 text-center mb-4">📷 Scan QR untuk Absen</h1>

        {{-- Scanner QR di dalam card --}}
        <div id="reader" class="rounded-md overflow-hidden border border-gray-300" style="width: 100%;"></div>
    </div>

    {{-- Catatan di bawah --}}
    <div class="mt-4 text-sm text-gray-500">
        Pastikan kamera aktif dan QR Code terlihat jelas.
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    function onScanSuccess(decodedText) {
        fetch('{{ route("user.absen.submit") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ kode_unik: decodedText })
        })
        .then(async response => {
            const data = await response.json();
            alert(data.message);
        })
        .catch(error => alert('Gagal scan: ' + error));
    }

    let html5QrcodeScanner = new Html5QrcodeScanner("reader", {
        fps: 10,
        qrbox: { width: 250, height: 250 }
    });
    html5QrcodeScanner.render(onScanSuccess);
</script>
@endpush
