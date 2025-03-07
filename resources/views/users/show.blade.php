@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Detail Pengguna</h2>
    
    <div class="mb-4">
        <label class="font-semibold text-gray-600">Nama:</label>
        <p class="text-gray-800">{{ $user->name }}</p>
    </div>
    
    <div class="mb-4">
        <label class="font-semibold text-gray-600">Email:</label>
        <p class="text-gray-800">{{ $user->email }}</p>
    </div>
    
    <div class="mb-4">
        <label class="font-semibold text-gray-600">Role:</label>
        <p class="text-gray-800 capitalize">{{ $user->role }}</p>
    </div>
    
    <div class="mb-4">
        <label class="font-semibold text-gray-600">Alamat:</label>
        <p class="text-gray-800">{{ $user->alamat ?? '-' }}</p>
    </div>
    
    <div class="mb-4">
        <label class="font-semibold text-gray-600">No. Telepon:</label>
        <p class="text-gray-800">{{ $user->no_telp ?? '-' }}</p>
    </div>
    
    <div class="flex space-x-4">
        <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Kembali</a>
        <a href="{{ route('users.edit', $user->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>

<form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
</form>

    </div>
</div>
@endsection
