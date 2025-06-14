@extends('layouts.user')

@section('title', 'Absensi')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 py-10">

    {{-- Card utama --}}
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-md border border-gray-200">
        
        {{-- Judul di dalam card dengan warna biru --}}
        <div class="text-center mb-4">
            <h1 class="text-2xl font-bold text-blue-600">📷 Scan QR untuk Absen</h1>
        </div>

        {{-- Dropdown Pilih Kamera --}}
        <div class="mb-4">
            <label for="camera-select" class="block text-sm font-medium text-gray-700 mb-1">Pilih Kamera:</label>
            <select id="camera-select" class="w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Memuat daftar kamera...</option>
            </select>
        </div>

        {{-- Area scanner kamera --}}
        <div id="reader" class="rounded-md overflow-hidden border border-gray-300 mb-4" style="width: 100%; height: 250px;"></div>

        {{-- Tombol kontrol --}}
        <div class="flex justify-center gap-4 mb-4">
            <button id="start-scan" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Mulai Scan</button>
            <button id="stop-scan" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Stop Scan</button>
        </div>

        {{-- Upload gambar QR --}}
        <div class="mt-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Atau upload gambar QR:</label>
            <input type="file" accept="image/*" id="qr-image-upload" class="block w-full border-gray-300 rounded-md shadow-sm" />
        </div>

        <canvas id="qr-canvas" class="hidden"></canvas>
    </div>

    {{-- Catatan tambahan --}}
    <div class="mt-4 text-sm text-gray-500 text-center px-6">
        Pastikan kamera aktif atau gambar QR terlihat jelas.
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>
<script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>

<script>
    const html5QrCode = new Html5Qrcode("reader");
    let isScanning = false;
    let scanCooldown = false;

    Html5Qrcode.getCameras().then(devices => {
        const select = document.getElementById('camera-select');
        select.innerHTML = '';
        devices.forEach(device => {
            const option = document.createElement('option');
            option.value = device.id;
            option.text = device.label || `Kamera ${select.length + 1}`;
            select.appendChild(option);
        });
    }).catch(err => {
        alert("Gagal memuat kamera: " + err);
    });

    function kirimAbsen(kode) {
        fetch('{{ route("user.absen.submit") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ kode_unik: kode })
        })
        .then(async res => {
            const data = await res.json();
            alert(data.message);
            scanCooldown = false;
        })
        .catch(() => {
            alert("Gagal mengirim data absen.");
            scanCooldown = false;
        });
    }

    function startCameraScan() {
        if (isScanning) return;
        isScanning = true;

        const selectedCameraId = document.getElementById('camera-select').value;
        html5QrCode.start(
            { deviceId: { exact: selectedCameraId } },
            { fps: 10, qrbox: { width: 250, height: 250 } },
            decodedText => {
                if (!scanCooldown) {
                    scanCooldown = true;
                    kirimAbsen(decodedText);
                    setTimeout(() => { scanCooldown = false; }, 2000);
                }
            },
            error => { /* Tidak perlu ditampilkan ke user */ }
        ).catch(err => {
            alert("Gagal membuka kamera: " + err);
            isScanning = false;
        });
    }

    function stopCameraScan() {
        if (!isScanning) return;
        html5QrCode.stop().then(() => {
            isScanning = false;
        }).catch(err => {
            alert("Gagal menghentikan kamera: " + err);
        });
    }

    document.getElementById('start-scan').addEventListener('click', startCameraScan);
    document.getElementById('stop-scan').addEventListener('click', stopCameraScan);

    // Scan dari gambar
    document.getElementById('qr-image-upload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            const img = new Image();
            img.onload = function() {
                const canvas = document.getElementById('qr-canvas');
                canvas.width = img.width;
                canvas.height = img.height;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0);
                const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                const code = jsQR(imageData.data, canvas.width, canvas.height);
                if (code) {
                    kirimAbsen(code.data);
                } else {
                    alert("QR tidak terbaca.");
                }
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    });
</script>
@endpush
