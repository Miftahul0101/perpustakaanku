@extends('layouts.app')

@section('content')
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Scan QR Code Buku</h2>
                    
                    <div class="mb-4">
                        <div id="reader" class="w-full"></div>
                    </div>

                    <!-- Book Details (Hidden by default) -->
                    <div id="bookDetails" class="hidden">
                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                            <h3 class="text-lg font-semibold mb-2">Detail Buku:</h3>
                            <p id="bookTitle" class="mb-1"></p>
                            <p id="bookAuthor" class="mb-1"></p>
                            <p id="bookISBN" class="mb-1"></p>
                        </div>

                        <!-- Borrowing Form -->
                        <form id="borrowForm" action="{{ route('peminjaman.store') }}" method="POST" class="hidden">
                            @csrf
                            <input type="hidden" name="buku_id" id="bukuId">
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Tanggal Pengembalian
                                </label>
                                <input type="date" name="tanggal_kembali" 
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                       required>
                            </div>

                            <div class="flex items-center justify-end">
                                <button type="submit" 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Pinjam Buku
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Error Message -->
                    <div id="errorMessage" class="hidden mt-4 p-4 text-red-700 bg-red-100 rounded-lg"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // Stop scanner after successful scan
            html5QrcodeScanner.clear();
            
            // Get book details
            // Pada bagian fetch dalam script scan.blade.php
fetch(`/peminjaman/get-buku/${decodedText}`)
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Show book details
            document.getElementById('bookDetails').classList.remove('hidden');
            document.getElementById('bookTitle').textContent = `Judul: ${data.buku.judul}`;
            document.getElementById('bookAuthor').textContent = `Penulis: ${data.buku.penulis}`;
            document.getElementById('bookISBN').textContent = `ISBN: ${data.buku.isbn}`;
            document.getElementById('bookStock').textContent = `Stok: ${data.buku.stok}`;
            
            // Show borrowing form
            document.getElementById('borrowForm').classList.remove('hidden');
            document.getElementById('bukuId').value = data.buku.id;
            
            // Hide error message if shown
            document.getElementById('errorMessage').classList.add('hidden');
        }
    })
    .catch(error => {
        document.getElementById('errorMessage').textContent = error.response?.data?.message || 'Buku tidak tersedia untuk dipinjam.';
        document.getElementById('errorMessage').classList.remove('hidden');
    });
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", 
            { 
                fps: 10, 
                qrbox: {
                    width: 250,
                    height: 250
                }
            }
        );
        html5QrcodeScanner.render(onScanSuccess);
    </script>

@endsection