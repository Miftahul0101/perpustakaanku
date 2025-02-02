@extends('layouts.app')

@section('content')
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Detail Buku</h2>
                        <a href="{{ route('buku.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Informasi Buku</h3>
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Judul</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $buku->judul }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Penulis</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $buku->penulis }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Penerbit</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $buku->penerbit ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tahun Terbit</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $buku->tahun_terbit ?? '-' }}</dd>
                                </div>
                                <div>
                                <dt class="text-sm font-medium text-gray-500">ISBN</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $buku->isbn ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Stok</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $buku->stok }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">QR Code</h3>
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <img src="data:image/png;base64,{{ $buku->qr_code }}" alt="QR Code" class="w-48 h-48 mx-auto">
                                <div class="mt-4 text-center">
                                    <a href="data:image/png;base64,{{ $buku->qr_code }}" download="qr-{{ $buku->isbn }}.png" 
                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block">
                                        Download QR Code
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection