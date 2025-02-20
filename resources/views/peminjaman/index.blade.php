@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-6">Daftar Peminjaman</h2>

                <!-- Filter Form -->
                <form method="GET" action="{{ route('peminjaman.index') }}" class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Mahasiswa</label>
                        <select name="user_id" id="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Mahasiswa</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="buku_id" class="block text-sm font-medium text-gray-700">Buku</label>
                        <select name="buku_id" id="buku_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Buku</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}" {{ request('buku_id') == $book->id ? 'selected' : '' }}>
                                    {{ $book->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Status</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Filter
                        </button>
                        @if(request()->hasAny(['user_id', 'buku_id', 'status']))
                            <a href="{{ route('peminjaman.index') }}" class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>

                <!-- Existing Table Content -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <!-- Your existing table header and content here -->
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mahasiswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Pinjam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Kembali</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Denda</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($peminjaman as $pinjam)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $pinjam->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $pinjam->buku->judul }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $pinjam->tanggal_pinjam }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $pinjam->tanggal_kembali }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($pinjam->status === 'dipinjam') bg-yellow-100 text-yellow-800 @else bg-green-100 text-green-800 @endif">
                                        {{ $pinjam->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($pinjam->denda, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($pinjam->status === 'dipinjam')
                                    <form action="{{ route('peminjaman.process-return') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="peminjaman_id" value="{{ $pinjam->id }}">
                                        <button type="submit" class="text-green-600 hover:text-green-900">Proses Pengembalian</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection