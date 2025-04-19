@extends('layouts.app')

@section('content')
<div class="py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-red-600 to-pink-600 px-6 py-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <h1 class="text-xl font-bold text-white">Daftar Denda Aktif (Real-time)</h1>
                <div class="flex space-x-2">
                    <a href="{{ route('denda.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-red-700 rounded-md shadow-sm hover:bg-gray-100 transition-colors duration-200 text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Manajemen Denda
                    </a>
                    <a href="{{ route('peminjaman.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-red-700 rounded-md shadow-sm hover:bg-gray-100 transition-colors duration-200 text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>

            <div class="p-6">
                <!-- Info Alert -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                <span class="font-bold">Informasi:</span> Denda bertambah secara otomatis sebesar Rp 1.000 per hari keterlambatan.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-lg shadow-md overflow-hidden">
                        <div class="px-6 py-5 text-white">
                            <h3 class="text-lg font-semibold opacity-90">Total Denda Aktif</h3>
                            <div class="mt-2 flex items-baseline">
                                <p class="text-2xl font-bold">Rp {{ number_format($activePeminjaman->sum('current_denda'), 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg shadow-md overflow-hidden">
                        <div class="px-6 py-5 text-white">
                            <h3 class="text-lg font-semibold opacity-90">Jumlah Peminjaman Terlambat</h3>
                            <div class="mt-2 flex items-baseline">
                                <p class="text-2xl font-bold">
                                    {{ $activePeminjaman->where('current_denda', '>', 0)->count() }} dari {{ $activePeminjaman->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="px-6 py-5 text-white">
                            <h3 class="text-lg font-semibold opacity-90">Rata-rata Denda</h3>
                            <div class="mt-2 flex items-baseline">
                                @php
                                    $lateLoans = $activePeminjaman->where('current_denda', '>', 0)->count();
                                    $avgDenda = $lateLoans > 0 ? 
                                        $activePeminjaman->sum('current_denda') / $lateLoans : 0;
                                @endphp
                                <p class="text-2xl font-bold">Rp {{ number_format($avgDenda, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search Filter -->
                <div class="mb-6">
                    <div class="bg-gray-50 rounded-lg border border-gray-200 p-4">
                        <h3 class="text-lg font-medium text-gray-800 mb-3">Filter Peminjaman</h3>
                        <form action="{{ route('peminjaman.activeLoansDenda') }}" method="GET">
                            <div class="flex flex-col sm:flex-row gap-3">
                                <div class="flex-grow">
                                    <input type="text" name="search" placeholder="Cari NIM / Nama / Judul Buku" class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" value="{{ request('search') }}">
                                </div>
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Main Table -->
                <div class="overflow-x-auto mb-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mahasiswa</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jatuh Tempo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterlambatan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Denda Saat Ini</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($activePeminjaman as $index => $pinjam)
                                <tr class="{{ $pinjam->current_denda > 0 ? 'bg-red-50' : '' }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $pinjam->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $pinjam->user->nim ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if(isset($pinjam->buku->foto))
                                                    <img class="h-10 w-10 rounded-md object-cover" src="{{ asset('storage/' . $pinjam->buku->foto) }}" alt="{{ $pinjam->buku->judul }}">
                                                @else
                                                    <div class="h-10 w-10 rounded-md bg-gray-200 flex items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $pinjam->buku->judul }}</div>
                                                <div class="text-sm text-gray-500">{{ $pinjam->buku->penulis }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($pinjam->tanggal_kembali)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if(now() > $pinjam->tanggal_kembali)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                {{ now()->diffInDays($pinjam->tanggal_kembali) }} hari
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Tepat waktu
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($pinjam->current_denda > 0)
                                            <div class="text-sm font-medium text-red-600" 
                                                 data-denda="{{ $pinjam->current_denda }}" 
                                                 data-return-date="{{ $pinjam->tanggal_kembali }}">
                                                Rp {{ number_format($pinjam->current_denda, 0, ',', '.') }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                Bertambah Rp 1.000/hari
                                            </div>
                                        @else
                                            <span class="text-sm font-medium text-green-600">Tidak ada denda</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="{{ route('peminjaman.processReturn') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="peminjaman_id" value="{{ $pinjam->id }}">
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" onclick="return confirm('Proses pengembalian buku ini? {{ $pinjam->current_denda > 0 ? 'Denda sebesar Rp '.number_format($pinjam->current_denda, 0, ',', '.').' akan dibebankan.' : '' }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Proses Pengembalian
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-10 text-center text-sm text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <p>Tidak ada data peminjaman aktif saat ini</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Summary Section -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-800">Rekap Denda per Mahasiswa</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mahasiswa</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Peminjaman</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Denda</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $userSummary = $activePeminjaman
                                        ->where('current_denda', '>', 0)
                                        ->groupBy('user_id')
                                        ->map(function($items) {
                                            return [
                                                'user' => $items->first()->user,
                                                'count' => $items->count(),
                                                'total_denda' => $items->sum('current_denda')
                                            ];
                                        })
                                        ->sortByDesc('total_denda');
                                @endphp

                                @forelse($userSummary as $summary)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $summary['user']->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $summary['user']->nim ?? 'N/A' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $summary['count'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">
                                            Rp {{ number_format($summary['total_denda'], 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                                            Tidak ada data denda
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for realtime counter simulation -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // This script simulates the real-time accumulation of fines
    // In a real application, this would be handled by the server
    const now = new Date();
    
    // Update the fine amount every minute to simulate real-time calculation
    setInterval(function() {
        const dendaElements = document.querySelectorAll('[data-denda]');
        dendaElements.forEach(function(element) {
            const baseAmount = parseInt(element.getAttribute('data-denda'));
            const returnDate = new Date(element.getAttribute('data-return-date'));
            const daysPassed = Math.floor((now - returnDate) / (1000 * 60 * 60 * 24));
            
            if (daysPassed > 0) {
                const newAmount = baseAmount + (Math.floor((now - returnDate) / (1000 * 60)) * (1000/1440));
                element.textContent = 'Rp ' + newAmount.toLocaleString('id-ID');
            }
        });
    }, 60000); // Update every minute
});
</script>
@endsection