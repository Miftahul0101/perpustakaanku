@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 bg-white p-6 rounded-xl shadow-md">
            <div class="mb-4 md:mb-0">
                @php
                    use Carbon\Carbon;
                @endphp
                <div class="text-gray-700 text-sm font-medium">
                    Waktu sekarang: {{ Carbon::now()->format('H:i:s') }}
                </div>
                <h1 class="text-3xl font-bold text-gray-800">Daftar Buku</h1>
                <p class="text-gray-600 mt-1">Temukan koleksi buku terbaik kami</p>
            </div>

            <!-- Tombol Tambah Buku (Hanya untuk Petugas) -->
            @if(auth()->user()->role === 'petugas')
                <a href="{{ route('buku.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 transition-colors duration-200 text-white font-medium rounded-lg shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Buku
                </a>
            @endif

            <!-- Tombol Scan QR Code (Hanya untuk Mahasiswa) -->
            @if(auth()->user()->role === 'mahasiswa')
                <a href="{{ route('buku.scanner') }}" 
                   class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 transition-colors duration-200 text-white font-medium rounded-lg shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Scan QR Code
                </a>
            @endif
        </div>

        <!-- Books Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($books as $book)
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-200 overflow-hidden">
                    @if($book->foto)
                        <div class="relative">
                            <img src="{{ Storage::url($book->foto) }}" 
                                 alt="{{ $book->judul }}" 
                                 class="w-full h-56 object-cover">
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 text-sm font-medium rounded-full
                                    {{ $book->status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $book->status }}
                                </span>
                            </div>
                        </div>
                    @endif

                    <div class="p-5">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2 line-clamp-2">{{ $book->judul }}</h3>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>{{ $book->penulis }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                <span>Stok: {{ $book->stok }}</span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <!-- Tombol Detail (Show) -->
                            <a href="{{ route('buku.show', $book->id) }}" 
                               class="block w-full text-center px-4 py-2 bg-gray-500 hover:bg-gray-600 transition-colors duration-200 text-white font-medium rounded-lg shadow-md">
                                Detail Buku
                            </a>

                            <!-- Tombol Edit (Hanya untuk Petugas) -->
                            @if(auth()->user()->role === 'petugas')
                                <a href="{{ route('buku.edit', $book->id) }}" 
                                   class="block w-full text-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 transition-colors duration-200 text-white font-medium rounded-lg shadow-md">
                                    Edit Buku
                                </a>
                                @if($book->qr_code)
                                <div class="flex flex-col items-center space-y-2 mt-4 pt-4 border-t border-gray-100">
                                    <img src="{{ Storage::url($book->qr_code) }}" 
                                         alt="QR Code" 
                                         class="w-24 h-24">
                                    <a href="{{ route('buku.download-qr', $book->id) }}" 
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                        Download QR Code
                                    </a>
                                </div>
                                <form action="{{ route('buku.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                            @endif
                                @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection