@extends('layouts.app')

@section('content')
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Pengembalian Buku</h2>

                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Detail Peminjaman:</h3>
                        <p>Peminjam: {{ $peminjaman->user->name }}</p>
                        <p>Buku: {{ $peminjaman->buku->judul }}</p>
                        <p>Tanggal Pinjam: {{ $peminjaman->tanggal_pinjam }}</p>
                        <p>Tanggal Kembali: {{ $peminjaman->tanggal_kembali }}</p>
                        
                        @if($peminjaman->denda > 0)
                            <p class="text-red-600 font-bold">
                                Denda: Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}
                            </p>
                        @endif
                    </div>

                    <form action="{{ route('peminjaman.confirm-return', $peminjaman->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Catatan Petugas
                            </label>
                            <textarea name="petugas_notes" 
                                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                      rows="3"></textarea>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" 
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Konfirmasi Pengembalian
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection