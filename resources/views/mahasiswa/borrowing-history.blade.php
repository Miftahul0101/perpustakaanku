@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Riwayat Peminjaman</h2>
                        @if($totalDenda > 0)
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded">
                                Total Denda: Rp {{ number_format($totalDenda, 0, ',', '.') }}
                            </div>
                        @endif
                    </div>

                    @if($peminjaman->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500">Belum ada riwayat peminjaman</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Batas Kembali</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Denda</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($peminjaman as $pinjam)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                @if($pinjam->buku->foto)
                                                    <img src="{{ Storage::url($pinjam->buku->foto) }}" 
                                                         alt="{{ $pinjam->buku->judul }}" 
                                                         class="h-10 w-10 object-cover rounded">
                                                @endif
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $pinjam->buku->judul }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $pinjam->buku->penulis }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($pinjam->tanggal_kembali)->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($pinjam->status === 'dipinjam') 
                                                    @if($pinjam->is_overdue)
                                                        bg-red-100 text-red-800
                                                    @else
                                                        bg-yellow-100 text-yellow-800
                                                    @endif
                                                @else 
                                                    bg-green-100 text-green-800 
                                                @endif">
                                                {{ $pinjam->status }}
                                                @if($pinjam->is_overdue)
                                                    (Terlambat {{ $pinjam->days_overdue }} hari)
                                                @endif
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                        @if($pinjam->status == 'dipinjam' && now() > $pinjam->tanggal_kembali)
                                        <span class="text-red-600 font-semibold">
                                            Rp {{ number_format($pinjam->current_denda, 0, ',', '.') }}
                                        </span>
                                        <span class="text-xs text-gray-500 block">
                                            ({{ now()->diffInDays($pinjam->tanggal_kembali) }} hari)
                                        </span>
                                    @elseif($pinjam->status == 'dikembalikan' && $pinjam->denda > 0)
                                        <span class="text-red-600">
                                            Rp {{ number_format($pinjam->denda, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection