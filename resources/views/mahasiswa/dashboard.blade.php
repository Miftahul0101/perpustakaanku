@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Hero Section with Gradient -->
    <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 rounded-2xl shadow-2xl p-8 mb-8">
        <div class="md:flex items-center justify-between">
            <div class="md:w-2/3">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p class="text-blue-100 text-lg">Mahasiswa Aktif - Semester {{ ceil((2024 - Auth::user()->mahasiswa->angkatan) * 2) }}</p>
            </div>
            <div class="mt-6 md:mt-0">
                <div class="bg-white/20 backdrop-blur-lg rounded-xl p-4 inline-block">
                    <p class="text-white text-sm">NIM</p>
                    <p class="text-white font-bold text-xl">{{ Auth::user()->mahasiswa->nim }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
        <!-- Profile Card -->
        <div class="md:col-span-4">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-pink-500 to-rose-500 p-4">
                    <div class="flex justify-center">
                        <img src="{{ Auth::user()->mahasiswa->foto 
                            ? Storage::url(Auth::user()->mahasiswa->foto) 
                            : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=ffffff&color=FF5733' }}" 
                            class="w-32 h-32 rounded-full border-4 border-white shadow-xl object-cover">
                    </div>
                </div>
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 text-center mb-4">{{ Auth::user()->name }}</h2>
                    <div class="space-y-3">
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>{{ Auth::user()->mahasiswa->nim }}</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ Auth::user()->email }}</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>{{ Auth::user()->no_telp ?? 'Belum diisi' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic Info -->
        <div class="md:col-span-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Jurusan Card -->
                <div class="bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl p-6 shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-emerald-100 text-sm">Jurusan</p>
                            <h3 class="text-white font-bold text-xl mt-1">{{ Auth::user()->mahasiswa->jurusan }}</h3>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Fakultas Card -->
                <div class="bg-gradient-to-br from-violet-500 to-purple-500 rounded-xl p-6 shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-violet-100 text-sm">Fakultas</p>
                            <h3 class="text-white font-bold text-xl mt-1">{{ Auth::user()->mahasiswa->fakultas }}</h3>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Angkatan Card -->
                <div class="bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl p-6 shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-amber-100 text-sm">Angkatan</p>
                            <h3 class="text-white font-bold text-xl mt-1">{{ Auth::user()->mahasiswa->angkatan }}</h3>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2v16z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Alamat Card -->
                <div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl p-6 shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm">Alamat</p>
                            <h3 class="text-white font-bold text-xl mt-1">{{ Auth::user()->alamat ?? 'Belum diisi' }}</h3>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-6 bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <a href="{{ route('mahasiswa.edit') }}" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300">
                        <svg class="w-6 h-6 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        <span class="text-gray-700">Edit Profil</span>
                    </a>
                    <a href="{{ route('mahasiswa.borrowing-history') }}" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300">
                        <svg class="w-6 h-6 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span class="text-gray-700">Riwayat Peminjaman</span>
                    </a>
                    <a href="#" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300">
                        <svg class="w-6 h-6 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Bantuan</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection