@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">Scan QR Code</h2>
                <p class="mt-2 text-sm text-gray-600">Arahkan kamera Anda ke QR Code untuk memindai.</p>
            </div>
            <div class="mt-8">
                <div id="reader" class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                    <span class="text-gray-500">Kamera akan muncul di sini...</span>
                </div>
                <div id="result" class="mt-4"></div>
            </div>
            <div class="mt-6 flex justify-center space-x-4">
                <button id="startButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Mulai Scan
                </button>
                <a href="{{ route('buku.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const html5QrCode = new Html5Qrcode("reader");
        const resultContainer = document.getElementById('result');
        const startButton = document.getElementById('startButton');
        
        let isScanning = false;
        
        startButton.addEventListener('click', function() {
            if (isScanning) {
                html5QrCode.stop().then(() => {
                    isScanning = false;
                    startButton.textContent = 'Mulai Scan';
                    startButton.classList.remove('bg-red-500');
                    startButton.classList.add('bg-blue-500');
                }).catch(err => {
                    console.error('Failed to stop scanning:', err);
                });
                return;
            }
            
            const config = { fps: 10, qrbox: 250 };
            
            html5QrCode.start(
                { facingMode: "environment" },
                config,
                (decodedText) => {
                    // On successful scan
                    resultContainer.innerHTML = `<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Berhasil!</strong>
                        <span class="block sm:inline">QR Code terdeteksi.</span>
                    </div>`;
                    
                    // Redirect to the URL in the QR code
                    window.location.href = decodedText;
                    
                    // Stop scanning
                    html5QrCode.stop();
                    isScanning = false;
                    startButton.textContent = 'Mulai Scan';
                    startButton.classList.remove('bg-red-500');
                    startButton.classList.add('bg-blue-500');
                },
                (errorMessage) => {
                    // On error, do nothing (this callback is required)
                }
            ).catch((err) => {
                resultContainer.innerHTML = `<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">${err}</span>
                </div>`;
            });
            
            isScanning = true;
            startButton.textContent = 'Stop Scan';
            startButton.classList.remove('bg-blue-500');
            startButton.classList.add('bg-red-500');
        });
    });
</script>
@endsection