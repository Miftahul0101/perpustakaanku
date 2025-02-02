{{-- resources/views/petugas/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class=" p-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Petugas</h1>
        <div class="flex items-center space-x-4">
            <span class="text-gray-600">Selamat Datang, {{ Auth::user()->name }}</span>
            <div class="relative group">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" 
                     class="w-10 h-10 rounded-full transition-transform duration-300 group-hover:scale-110">
                <div class="absolute inset-0 rounded-full bg-blue-500 opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Total Mahasiswa Card --}}
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-6 shadow-lg transform hover:scale-105 transition-all duration-300 hover:from-blue-600 hover:to-blue-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white text-sm opacity-80">Total Mahasiswa</p>
                    <h3 class="text-white text-2xl font-bold">{{ $totalMahasiswa }}</h3>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Buku Card --}}
        <div class="bg-gradient-to-br from-blue-400 to-blue-500 rounded-lg p-6 shadow-lg transform hover:scale-105 transition-all duration-300 hover:from-blue-500 hover:to-blue-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white text-sm opacity-80">Total Buku</p>
                    <h3 class="text-white text-2xl font-bold">{{ $totalBuku }}</h3>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Kategori Card --}}
        <div class="bg-gradient-to-br from-blue-300 to-blue-400 rounded-lg p-6 shadow-lg transform hover:scale-105 transition-all duration-300 hover:from-blue-400 hover:to-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white text-sm opacity-80">Total Kategori</p>
                    <h3 class="text-white text-2xl font-bold">{{ $totalKategori }}</h3>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Latest Mahasiswa Table --}}
        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:shadow-xl transition-all duration-300">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Mahasiswa Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-blue-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">NIM</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Fakultas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($latestMahasiswa as $mahasiswa)
                            <tr class="hover:bg-blue-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $mahasiswa->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $mahasiswa->nim }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $mahasiswa->fakultas }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Popular Categories --}}
        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:shadow-xl transition-all duration-300">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Kategori Populer</h2>
            <div class="space-y-4">
                @foreach($popularKategori as $kategori)
                    <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                        <span class="text-blue-800 font-medium">{{ $kategori->kategori->nama }}</span>
                        <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm">{{ $kategori->total }} buku</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Faculty Distribution --}}
        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:shadow-xl transition-all duration-300">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Fakultas</h2>
            <div class="space-y-4">
                @foreach($mahasiswaByFakultas as $fakultas)
                    <div class="relative">
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-blue-800">{{ $fakultas->fakultas }}</span>
                            <span class="text-sm font-medium text-blue-800">{{ $fakultas->total }}</span>
                        </div>
                        <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-100">
                            <div style="width: {{ ($fakultas->total / $totalMahasiswa) * 100 }}%"
                                 class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-gradient-to-r from-blue-400 to-blue-600 hover:from-blue-500 hover:to-blue-700 transition-all duration-300"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Animations */
    @keyframes pulse-blue {
        0% {
            box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.5);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(59, 130, 246, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
        }
    }

    .stat-card:hover {
        animation: pulse-blue 2s infinite;
    }
</style>
@endsection