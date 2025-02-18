@extends('layouts.app')

@section('content')
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Form Peminjaman Buku</h2>

                    <form action="{{ route('peminjaman.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="buku_id" value="{{ $buku->id }}">

                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Detail Buku:</h3>
                            <p>Judul: {{ $buku->judul }}</p>
                            <p>Penulis: {{ $buku->penulis }}</p>
                            <p>ISBN: {{ $buku->isbn }}</p>
                        </div>

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
            </div>
        </div>
    </div>
@endsection