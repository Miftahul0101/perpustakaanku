@extends('layouts.app')

@section('content')    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <a href="{{ route('buku.index') }}" class="text-blue-500 hover:text-blue-700">
                            &larr; Kembali ke Daftar Buku
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h2 class="text-2xl font-bold mb-4">Detail Buku</h2>
                            <div class="space-y-3">
                                <p><span class="font-semibold">Judul:</span> {{ $buku->judul }}</p>
                                <p><span class="font-semibold">Penulis:</span> {{ $buku->penulis }}</p>
                                <p><span class="font-semibold">Penerbit:</span> {{ $buku->penerbit ?? '-' }}</p>
                                <p><span class="font-semibold">Tahun Terbit:</span> {{ $buku->tahun_terbit ?? '-' }}</p>
                                <p><span class="font-semibold">ISBN:</span> {{ $buku->isbn ?? '-' }}</p>
                                <p><span class="font-semibold">Stok:</span> {{ $buku->stok }}</p>
                            </div>

                            <div class="mt-6 space-x-2">
                                <a href="{{ route('buku.edit', $buku) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                    Edit
                                </a>
                                <form action="{{ route('buku.destroy', $buku) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="flex flex-col items-center justify-center">
                            <h3 class="text-xl font-semibold mb-4">QR Code</h3>
                            <div class="border p-4 rounded-lg shadow-md">
                                <img src="{{ $buku->qr_code }}" alt="QR Code {{ $buku->judul }}" class="w-64 h-64">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection