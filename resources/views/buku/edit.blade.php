@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Edit Buku</h2>
                    <a href="{{ route('buku.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-gray-700 transition-colors duration-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                </div>

                <form method="POST" action="{{ route('buku.update', $buku->id) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-6">
                            <!-- Judul Buku -->
                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700">Judul Buku</label>
                                <input id="judul" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('judul') border-red-500 @enderror" name="judul" value="{{ old('judul', $buku->judul) }}" required>
                                @error('judul')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Penulis -->
                            <div>
                                <label for="penulis" class="block text-sm font-medium text-gray-700">Penulis</label>
                                <input id="penulis" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('penulis') border-red-500 @enderror" name="penulis" value="{{ old('penulis', $buku->penulis) }}" required>
                                @error('penulis')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Penerbit -->
                            <div>
                                <label for="penerbit" class="block text-sm font-medium text-gray-700">Penerbit</label>
                                <input id="penerbit" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('penerbit') border-red-500 @enderror" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}">
                                @error('penerbit')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tahun Terbit -->
                            <div>
                                <label for="tahun_terbit" class="block text-sm font-medium text-gray-700">Tahun Terbit</label>
                                <input id="tahun_terbit" type="number" min="1900" max="{{ date('Y') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('tahun_terbit') border-red-500 @enderror" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}">
                                @error('tahun_terbit')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-6">
                            <!-- ISBN -->
                            <div>
                                <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                                <input id="isbn" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('isbn') border-red-500 @enderror" name="isbn" value="{{ old('isbn', $buku->isbn) }}">
                                @error('isbn')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Stok -->
                            <div>
                                <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                                <input id="stok" type="number" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('stok') border-red-500 @enderror" name="stok" value="{{ old('stok', $buku->stok) }}" required>
                                @error('stok')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Foto Buku -->
                            <div>
                                <label for="foto" class="block text-sm font-medium text-gray-700">Foto Buku</label>
                                @if($buku->foto)
                                    <div class="mt-2 mb-3">
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $buku->foto) }}" alt="{{ $buku->judul }}" class="object-cover h-48 w-full rounded-lg shadow-md">
                                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded-lg">
                                                <span class="text-white text-sm">Foto saat ini</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="mt-1 flex items-center">
                                    <label for="foto" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                        <span class="block w-full px-3 py-2 border border-gray-300 border-dashed rounded-md text-center text-sm text-gray-600 hover:border-indigo-500 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span class="mt-2 block">Pilih foto baru</span>
                                        </span>
                                        <input id="foto" name="foto" type="file" class="sr-only">
                                    </label>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengubah foto</p>
                                @error('foto')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Sinopsis -->
                    <div>
                        <label for="sinopsis" class="block text-sm font-medium text-gray-700">Sinopsis</label>
                        <textarea id="sinopsis" name="sinopsis" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('sinopsis') border-red-500 @enderror">{{ old('sinopsis', $buku->sinopsis) }}</textarea>
                        @error('sinopsis')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="{{ route('buku.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md transition-colors duration-200">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow-sm transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection