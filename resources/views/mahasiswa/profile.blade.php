@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
<div class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-4 py-5 sm:px-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl leading-6 font-medium text-white">Profil Mahasiswa</h3>
                    <a href="{{ route('mahasiswa.edit') }}" class="bg-white text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-md text-sm font-medium">
                        Edit Profil
                    </a>
                </div>
            </div>

            <div class="border-t border-gray-200">
                <div class="flex">
                    <!-- Foto Profil -->
                    <div class="w-1/3 p-6 border-r border-gray-200">
                        <div class="aspect-w-1 aspect-h-1">
                            @if($mahasiswa->foto)
                                <img src="{{ Storage::url('/' . $mahasiswa->foto) }}" 
                                     alt="Foto Profil" 
                                     class="object-cover rounded-lg shadow">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center rounded-lg">
                                    <svg class="w-20 h-20 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Informasi Profil -->
                    <div class="w-2/3 p-6">
                        <dl class="grid grid-cols-1 gap-y-4">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $user->name }}</dd>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">NIM</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $mahasiswa->nim }}</dd>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $user->email }}</dd>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Fakultas</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $mahasiswa->fakultas }}</dd>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Jurusan</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $mahasiswa->jurusan }}</dd>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Angkatan</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $mahasiswa->angkatan }}</dd>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </dd>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Tanggal Lahir</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->format('d F Y') }}
                                </dd>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $user->alamat ?? '-' }}</dd>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">No. Telepon</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $user->no_telp ?? '-' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
@endsection