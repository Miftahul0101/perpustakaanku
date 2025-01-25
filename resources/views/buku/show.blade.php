@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Detail Buku</h2>
                    <a href="{{ route('buku.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Kembali
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">Informasi Dasar</h3>
                            <div class="mt-2 space-y-2">
                                <p class="text-gray-600"><span class="font-medium">Judul:</span> {{ $buku->judul }}</p>
                                <p class="text-gray-600"><span class="font-medium">Penulis:</span> {{ $buku->penulis }}</p>
                                <p class="text-gray-600"><span class="font-medium">Penerbit:</span> {{ $buku->penerbit ?? '-' }}</p>
                                <p class="text-gray-600"><span class="font-medium">Tahun Terbit:</span> {{ $buku->tahun_terbit ?? '-' }}</p>
                                <p class="text-gray-600"><span class="font-medium">ISBN:</span> {{ $buku->isbn ?? '-' }}</p>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">Status dan Ketersediaan</h3>
                            <div class="mt-2 space-y-2">
                                <p class="text-gray-600">
                                    <span class="font-medium">Status:</span>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $buku->status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $buku->status }}
                                    </span>
                                </p>
                                <p class="text-gray-600"><span class="font-medium">Stok:</span> {{ $buku->stok }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">Kategori</h3>
                        <div class="flex flex-wrap gap-2">
                            @forelse($buku->kategoris as $kategori)
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                    {{ $kategori->nama }}
                                </span>
                            @empty
                                <p class="text-gray-500 italic">Belum ada kategori</p>
                            @endforelse
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('buku.kategori.index', $buku) }}" 
                               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded inline-block">
                                Kelola Kategori
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex space-x-4">
                    <a href="{{ route('buku.edit', $buku) }}" 
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                        Edit Buku
                    </a>
                    <form action="{{ route('buku.destroy', $buku) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                            Hapus Buku
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection