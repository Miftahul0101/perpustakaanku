@extends('layouts.app')

@section('content')
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Daftar Buku</h2>
                        @if(auth()->user()->role === 'petugas')
                        <a href="{{ route('buku.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Buku
                        </a>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($books as $book)
                        <div class="border rounded-lg overflow-hidden shadow-lg">
                            @if($book->foto)
                            <img src="{{ Storage::url($book->foto) }}" alt="{{ $book->judul }}" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-2">{{ $book->judul }}</h3>
                                <p class="text-gray-600">Penulis: {{ $book->penulis }}</p>
                                <p class="text-gray-600">Stok: {{ $book->stok }}</p>
                                <p class="text-gray-600">Status: 
                                    <span class="@if($book->status === 'tersedia') text-green-500 @else text-red-500 @endif">
                                        {{ $book->status }}
                                    </span>
                                </p>
                                @if(auth()->user()->role === 'mahasiswa' && $book->status === 'tersedia')
                                <a href="{{ route('buku.scan', $book->id) }}" class="mt-4 inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Pinjam Buku
                                </a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection