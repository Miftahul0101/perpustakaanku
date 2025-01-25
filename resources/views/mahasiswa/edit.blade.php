<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Left Section: Logo and Links -->
            <div class="flex items-center space-x-6">
                <span class="text-blue-600 text-xl font-bold">Perpustakaanku</span>
                <a href="{{ route('mahasiswa.dashboard') }}" class="text-gray-600 hover:text-blue-600 font-medium">
                    Dashboard
                </a>
                <a href="{{ route('mahasiswa.index') }}" class="text-gray-600 hover:text-blue-600 font-medium">
                    Profile
                </a>
            </div>

            <!-- Right Section: User Info and Logout -->
            <div class="flex items-center space-x-6">
                <!-- User Info -->
                <div class="flex items-center space-x-2">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" 
                         class="w-8 h-8 rounded-full" 
                         alt="User Avatar">
                    <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                </div>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-600 hover:text-gray-800">
                        <i class="ri-logout-box-line text-xl"></i>
                        <span class="sr-only">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
<div class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-4 py-5 sm:px-6">
                <h3 class="text-xl leading-6 font-medium text-white">Edit Profil</h3>
            </div>

            <form action="{{ route('mahasiswa.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    <!-- Foto Profile -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Foto Profil
                        </label>
                        <div class="flex items-center space-x-6">
                            <div class="w-24 h-24 rounded-lg overflow-hidden bg-gray-100">
                                @if($mahasiswa->foto)
                                    <img src="{{ Storage::url('foto_mahasiswa/' . $mahasiswa->foto) }}" 
                                         alt="Current profile photo" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <input type="file" name="foto" id="foto" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                        @error('foto')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Name -->
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fakultas -->
                    <div>
                        <label for="fakultas" class="block text-sm font-medium text-gray-700">Fakultas</label>
                        <input type="text" name="fakultas" id="fakultas" value="{{ old('fakultas', $mahasiswa->fakultas) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('fakultas')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jurusan -->
                    <div>
                        <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan</label>
                        <input type="text" name="jurusan" id="jurusan" value="{{ old('jurusan', $mahasiswa->jurusan) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('jurusan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="L" {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" 
                               value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('tanggal_lahir')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="sm:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('alamat', $user->alamat) }}</textarea>
                        @error('alamat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No Telp -->
                    <div class="sm:col-span-2">
                        <label for="no_telp" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                        <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp', $user->no_telp) }}">
                        @error('no_telp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Submit
                        </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>