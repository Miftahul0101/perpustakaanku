@extends('layouts.app')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8 mx-auto max-w-7xl">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('buku.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Buku
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    {{ $buku->judul }}
                </h2>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Oleh: {{ $buku->penulis }}
                </p>
            </div>
            
        </div>

        <div class="border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-4 py-5 sm:p-6">
                <!-- Book Image -->
                <div class="md:col-span-1">
                    @if($buku->foto)
                        <img src="{{ Storage::url($buku->foto) }}" 
                             alt="{{ $buku->judul }}" 
                             class="w-full h-auto rounded-lg shadow-lg object-cover">
                    @else
                        <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Book Details -->
                <div class="md:col-span-2 space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Informasi Buku</h3>
                            <dl class="mt-4 space-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Penerbit</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $buku->penerbit ?? 'Tidak tersedia' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tahun Terbit</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $buku->tahun_terbit ?? 'Tidak tersedia' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">ISBN</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $buku->isbn ?? 'Tidak tersedia' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Stok</dt>
                                    <dd class="mt-1 text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $buku->stok > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $buku->stok }} tersedia
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <!-- QR Code Display -->
                        @if($buku->qr_code)
                        <div class="flex flex-col items-center justify-center">
                            <img src="{{ Storage::url($buku->qr_code) }}" 
                                 alt="QR Code {{ $buku->judul }}" 
                                 class="w-32 h-32 object-contain">
                            <p class="mt-2 text-sm text-gray-500">Scan untuk meminjam</p>
                        </div>
                        @endif
                    </div>

                    <!-- Synopsis -->
                    @if($buku->sinopsis)
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900">Sinopsis</h3>
                        <div class="mt-4 prose prose-indigo">
                            <p class="text-gray-700">{{ $buku->sinopsis }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="mt-6 flex flex-wrap gap-4">
                        
                        @if(auth()->user()->role === 'mahasiswa' && $buku->status === 'tersedia')
                        <a href="{{ route('peminjaman.create', ['buku_id' => $buku->id]) }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Pinjam Buku
                        </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection