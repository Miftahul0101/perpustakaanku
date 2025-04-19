@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-gradient-to-br from-blue-50 to-indigo-50">
    <div class="max-w-4xl mx-auto animate-fade-in">
        <!-- Card with glass morphism effect -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-blue-100">
            <!-- Header with animated gradient -->
            <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 px-6 py-5 relative overflow-hidden">
                <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:20px_20px]"></div>
                <div class="absolute h-32 w-32 rounded-full bg-blue-500/20 -top-10 -right-10 blur-2xl"></div>
                <div class="absolute h-20 w-20 rounded-full bg-indigo-500/20 top-10 right-10 blur-xl"></div>
                
                <div class="flex items-center justify-between relative z-10">
                    <h1 class="text-2xl font-bold text-white flex items-center">
                        <i class="ri-user-line mr-3 text-blue-200"></i>
                        Detail Mahasiswa
                    </h1>
                    <span class="px-3 py-1 bg-blue-500/30 text-white text-sm rounded-full border border-blue-400/30 backdrop-blur-sm">
                        {{ $mahasiswa->angkatan }}
                    </span>
                </div>
            </div>

            <!-- Profile section -->
            <div class="p-6 md:p-8">
                <!-- Student profile header -->
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 mb-8 p-4 bg-blue-50 rounded-xl border border-blue-100 transition-all duration-300 hover:shadow-md hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50">
                    <img
                    src="{{ Storage::url($mahasiswa->foto) }}"
                    class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-3xl font-bold shadow-lg transform transition-transform hover:scale-105">
                    
                    <div class="text-center sm:text-left">
                        <h2 class="text-2xl font-bold text-gray-800">{{ $mahasiswa->user->name }}</h2>
                        <p class="text-blue-600 font-medium">{{ $mahasiswa->nim }}</p>
                        <div class="mt-2 flex flex-wrap justify-center sm:justify-start gap-2">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                                {{ $mahasiswa->jurusan }}
                            </span>
                            <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm font-medium">
                                {{ $mahasiswa->fakultas }}
                            </span>
                            <span class="px-3 py-1 bg-{{ $mahasiswa->jenis_kelamin == 'Laki-laki' ? 'blue' : 'pink' }}-100 text-{{ $mahasiswa->jenis_kelamin == 'Laki-laki' ? 'blue' : 'pink' }}-700 rounded-full text-sm font-medium">
                                <i class="ri-{{ $mahasiswa->jenis_kelamin == 'Laki-laki' ? 'men' : 'women' }}-line mr-1"></i>
                                {{ $mahasiswa->jenis_kelamin }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Information grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <!-- Academic Information -->
                        <h3 class="text-lg font-semibold text-gray-700 border-b border-blue-100 pb-2 mb-4">
                            <i class="ri-book-open-line mr-2 text-blue-500"></i>Informasi Akademik
                        </h3>
                        
                        <div class="group bg-white p-4 rounded-xl border border-blue-100 shadow-sm transition-all duration-300 hover:shadow-md hover:border-blue-300 hover:bg-blue-50/50">
                            <label class="text-sm font-medium text-gray-500">NIM</label>
                            <p class="mt-1 text-lg text-gray-900 group-hover:text-blue-700 transition-colors">{{ $mahasiswa->nim }}</p>
                        </div>

                        <div class="group bg-white p-4 rounded-xl border border-blue-100 shadow-sm transition-all duration-300 hover:shadow-md hover:border-blue-300 hover:bg-blue-50/50">
                            <label class="text-sm font-medium text-gray-500">Jurusan</label>
                            <p class="mt-1 text-lg text-gray-900 group-hover:text-blue-700 transition-colors">{{ $mahasiswa->jurusan }}</p>
                        </div>

                        <div class="group bg-white p-4 rounded-xl border border-blue-100 shadow-sm transition-all duration-300 hover:shadow-md hover:border-blue-300 hover:bg-blue-50/50">
                            <label class="text-sm font-medium text-gray-500">Fakultas</label>
                            <p class="mt-1 text-lg text-gray-900 group-hover:text-blue-700 transition-colors">{{ $mahasiswa->fakultas }}</p>
                        </div>

                        <div class="group bg-white p-4 rounded-xl border border-blue-100 shadow-sm transition-all duration-300 hover:shadow-md hover:border-blue-300 hover:bg-blue-50/50">
                            <label class="text-sm font-medium text-gray-500">Angkatan</label>
                            <p class="mt-1 text-lg text-gray-900 group-hover:text-blue-700 transition-colors">{{ $mahasiswa->angkatan }}</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <!-- Personal Information -->
                        <h3 class="text-lg font-semibold text-gray-700 border-b border-blue-100 pb-2 mb-4">
                            <i class="ri-profile-line mr-2 text-blue-500"></i>Informasi Pribadi
                        </h3>
                        
                        <div class="group bg-white p-4 rounded-xl border border-blue-100 shadow-sm transition-all duration-300 hover:shadow-md hover:border-blue-300 hover:bg-blue-50/50">
                            <label class="text-sm font-medium text-gray-500">Nama Lengkap</label>
                            <p class="mt-1 text-lg text-gray-900 group-hover:text-blue-700 transition-colors">{{ $mahasiswa->user->name }}</p>
                        </div>

                        <div class="group bg-white p-4 rounded-xl border border-blue-100 shadow-sm transition-all duration-300 hover:shadow-md hover:border-blue-300 hover:bg-blue-50/50">
                            <label class="text-sm font-medium text-gray-500">Email</label>
                            <p class="mt-1 text-lg text-gray-900 group-hover:text-blue-700 transition-colors flex items-center">
                                <i class="ri-mail-line mr-2 text-blue-400"></i>
                                {{ $mahasiswa->user->email }}
                            </p>
                        </div>

                        <div class="group bg-white p-4 rounded-xl border border-blue-100 shadow-sm transition-all duration-300 hover:shadow-md hover:border-blue-300 hover:bg-blue-50/50">
                            <label class="text-sm font-medium text-gray-500">Tanggal Lahir</label>
                            <p class="mt-1 text-lg text-gray-900 group-hover:text-blue-700 transition-colors flex items-center">
                                <i class="ri-calendar-line mr-2 text-blue-400"></i>
                                {{ $mahasiswa->tanggal_lahir }}
                            </p>
                        </div>

                        <div class="group bg-white p-4 rounded-xl border border-blue-100 shadow-sm transition-all duration-300 hover:shadow-md hover:border-blue-300 hover:bg-blue-50/50">
                            <label class="text-sm font-medium text-gray-500">No. Telepon</label>
                            <p class="mt-1 text-lg text-gray-900 group-hover:text-blue-700 transition-colors flex items-center">
                                <i class="ri-phone-line mr-2 text-blue-400"></i>
                                {{ $mahasiswa->user->no_telp }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Address section -->
                <div class="mt-6">
                    <div class="group bg-white p-4 rounded-xl border border-blue-100 shadow-sm transition-all duration-300 hover:shadow-md hover:border-blue-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50">
                        <label class="text-sm font-medium text-gray-500 flex items-center">
                            <i class="ri-map-pin-line mr-2 text-blue-500"></i>Alamat
                        </label>
                        <p class="mt-1 text-lg text-gray-900 group-hover:text-blue-700 transition-colors">{{ $mahasiswa->user->alamat }}</p>
                    </div>
                </div>

                <!-- Action buttons -->
                <div class="mt-8 flex flex-wrap justify-between items-center gap-4">
                    <a href="{{ route('adminmahasiswa.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-all duration-300 hover:shadow-md">
                        <i class="ri-arrow-left-line mr-2"></i>
                        Kembali
                    </a>
                    
                    <div class="flex flex-wrap gap-3">
                        
                        
                        <form action="{{ route('adminmahasiswa.destroy', $mahasiswa) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-lg transition-all duration-300 hover:shadow-md transform hover:-translate-y-1">
                                <i class="ri-delete-bin-line mr-2"></i>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }
    
    /* Grid background pattern */
    .bg-grid-white {
        background-image: linear-gradient(to right, rgba(255,255,255,0.1) 1px, transparent 1px),
                          linear-gradient(to bottom, rgba(255,255,255,0.1) 1px, transparent 1px);
    }
    
    /* Custom hover animations for group elements */
    .group:hover {
        transform: translateY(-2px);
    }
</style>
@endsection