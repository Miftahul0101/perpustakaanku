@extends('layouts.app')

@section('content')

<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Daftar Buku</h2>
                <a href="{{ route('buku.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Tambah Buku
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($books as $book)
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $book->judul }}</h3>
                            <div class="text-gray-600">
                                <p class="mb-1"><span class="font-medium">Penulis:</span> {{ $book->penulis }}</p>
                                <p class="mb-1"><span class="font-medium">Penerbit:</span> {{ $book->penerbit ?? '-' }}</p>
                                <p class="mb-1"><span class="font-medium">Tahun:</span> {{ $book->tahun_terbit ?? '-' }}</p>
                                <p class="mb-1"><span class="font-medium">ISBN:</span> {{ $book->isbn ?? '-' }}</p>
                                <p class="mb-1"><span class="font-medium">Stok:</span> {{ $book->stok }}</p>
                                <p class="mb-3">
                                    <span class="font-medium">Status:</span>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $book->status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $book->status }}
                                    </span>
                                </p>
                            </div>
                            <div class="flex justify-end space-x-2 mt-4">
    <a href="{{ route('buku.show', $book) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
        Detail
    </a>
    <a href="{{ route('buku.kategori.index', $book) }}" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
        Kategori
    </a>
    
    <a href="{{ route('buku.edit', $book) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
        Edit
    </a>
    <form action="{{ route('buku.destroy', $book) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded" 
                onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
            Hapus
        </button>
    </form>
</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $books->links() }}
            </div>
        </div>
    </div>
@endsection