@extends('layouts.app')

@section('content')
<div class="ml-64 p-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">Selamat Datang, {{ Auth::user()->name }}</span>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" class="w-10 h-10 rounded-full">
            </div>
        </div>
    </div>
@endsection
