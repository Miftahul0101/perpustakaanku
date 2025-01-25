@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
                <h1 class="text-xl font-bold text-white flex items-center">
                    <i class="ri-user-line mr-2"></i>
                    Detail Mahasiswa
                </h1>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="text-sm font-medium text-gray-500">NIM</label>
                            <p class="mt-1 text-lg text-gray-900">{{ $mahasiswa->nim }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="text-sm font-medium text-gray-500">Nama</label>
                            <p class="mt-1 text-lg text-gray-900">{{ $mahasiswa->user->name }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="text-sm font-medium text-gray-500">Email</label>
                            <p class="mt-1 text-lg text-gray-900">{{ $mahasiswa->user->email }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="text-sm font-medium text-gray-500">Jurusan</label>
                            <p class="mt-1 text-lg text-gray-900">{{ $mahasiswa->jurusan }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="text-sm font-medium text-gray-500">Fakultas</label>
                            <p class="mt-1 text-lg text-gray-900">{{ $mahasiswa->fakultas }}</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="text-sm font-medium text-gray-500">Angkatan</label>
                            <p class="mt-1 text-lg text-gray-900">{{ $mahasiswa->angkatan }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="text-sm font-medium text-gray-500">Jenis Kelamin</label>
                            <p class="mt-1 text-lg text-gray-900">{{ $mahasiswa->jenis_kelamin }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="text-sm font-medium text-gray-500">Tanggal Lahir</label>
                            <p class="mt-1 text-lg text-gray-900">{{ $mahasiswa->tanggal_lahir }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="text-sm font-medium text-gray-500">Alamat</label>
                            <p class="mt-1 text-lg text-gray-900">{{ $mahasiswa->user->alamat }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="text-sm font-medium text-gray-500">No. Telepon</label>
                            <p class="mt-1 text-lg text-gray-900">{{ $mahasiswa->user->no_telp }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <a href="{{ route('adminmahasiswa.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition duration-150">
                        <i class="ri-arrow-left-line mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection