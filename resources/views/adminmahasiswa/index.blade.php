@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
            <h1 class="text-xl font-bold text-white flex items-center">
                <i class="ri-user-line mr-2"></i>
                Daftar Mahasiswa
            </h1>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 m-4" role="alert">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="p-6">
            <div class="mb-4 flex justify-between items-center">
                <div class="relative">
                    <input type="text" id="search" placeholder="Cari mahasiswa..." 
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <i class="ri-search-line absolute left-3 top-2.5 text-gray-400"></i>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fakultas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Angkatan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($mahasiswa as $mhs)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mhs->nim }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mhs->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mhs->jurusan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mhs->fakultas }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mhs->angkatan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mhs->jenis_kelamin }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('adminmahasiswa.show', $mhs) }}" 
                                       class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition duration-150">
                                        <i class="ri-eye-line mr-1"></i>
                                        Detail
                                    </a>
                                    <form action="{{ route('adminmahasiswa.destroy', $mhs) }}" 
                                          method="POST" 
                                          class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-md transition duration-150"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="ri-delete-bin-line mr-1"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection