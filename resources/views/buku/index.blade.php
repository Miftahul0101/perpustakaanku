@extends('layouts.app')

@section('content')
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between mb-6">
                        <h2 class="text-2xl font-bold">Daftar Buku</h2>
                        <a href="{{ route('buku.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Buku
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($books as $book)
                            <div class="border rounded-lg p-4 shadow hover:shadow-md transition-shadow">
                                <div class="flex justify-center mb-4">
                                    <img src="{{ $book->qr_code }}" alt="QR Code {{ $book->judul }}" class="w-32 h-32">
                                </div>
                                <h3 class="text-lg font-semibold mb-2">{{ $book->judul }}</h3>
                                <p class="text-gray-600 mb-1">Penulis: {{ $book->penulis }}</p>
                                <p class="text-gray-600 mb-1">ISBN: {{ $book->isbn }}</p>
                                <p class="text-gray-600 mb-4">Stok: {{ $book->stok }}</p>
                                
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('buku.show', $book) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                        Detail
                                    </a>
                                    <a href="{{ route('buku.edit', $book) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('buku.destroy', $book) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm" onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection