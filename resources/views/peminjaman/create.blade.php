@extends('layouts.app')

@section('content')
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-6">Form Peminjaman Buku</h2>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold">Detail Buku:</h3>
                        <p>Judul: {{ $buku->judul }}</p>
                        <p>Penulis: {{ $buku->penulis }}</p>
                        <p>Stok Tersedia: {{ $buku->stok }}</p>
                    </div>

                    <form action="{{ route('peminjaman.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="buku_id" value="{{ $buku->id }}">

                        <div>
                            <label for="tanggal_pinjam" class="block text-sm font-medium text-gray-700">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="tanggal_kembali" class="block text-sm font-medium text-gray-700">Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="{{ date('Y-m-d', strtotime('+7 days')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Konfirmasi Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection