@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-gray-50">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Statistics Cards --}}
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm uppercase font-medium">Total Mahasiswa</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ $totalMahasiswa }}</p>
                </div>
                <i class="ri-user-line text-4xl text-blue-300"></i>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm uppercase font-medium">Total Buku</h3>
                    <p class="text-2xl font-bold text-green-600">{{ $totalBuku }}</p>
                </div>
                <i class="ri-book-line text-4xl text-green-300"></i>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm uppercase font-medium">Jurusan Terdaftar</h3>
                    <p class="text-2xl font-bold text-purple-600">{{ $totalJurusan }}</p>
                </div>
                <i class="ri-graduation-cap-line text-4xl text-purple-300"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
            <h1 class="text-xl font-bold text-white flex items-center">
                <i class="ri-user-line mr-2"></i>
                Daftar Mahasiswa Terbaru
            </h1>
        </div>

        <div class="p-6">
            <div class="mb-4 flex justify-between items-center">
                <div class="relative w-full md:w-1/3">
                    <input type="text" id="search" placeholder="Cari mahasiswa..." 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <i class="ri-search-line absolute left-3 top-2.5 text-gray-400"></i>
                </div>
                
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Jurusan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Angkatan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($mahasiswaTerbaru as $mhs)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mhs->nim }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div class="flex items-center">
                                        <img src="{{ Storage::url('/' . $mhs->foto) }}" 
                                             alt="{{ $mhs->user->name }}" 
                                             class="w-10 h-10 rounded-full mr-3">
                                        {{ $mhs->user->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 hidden md:table-cell">{{ $mhs->jurusan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 hidden lg:table-cell">{{ $mhs->angkatan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('adminmahasiswa.show', $mhs) }}" 
                                       class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition duration-150">
                                        <i class="ri-eye-line mr-1"></i>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const rows = document.querySelectorAll('tbody tr');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const match = Array.from(cells).some(cell => 
                    cell.textContent.toLowerCase().includes(searchTerm)
                );
                row.style.display = match ? '' : 'none';
            });
        });
    });
</script>

@endsection

