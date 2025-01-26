<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 via-blue-200 to-blue-300 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full bg-white shadow-2xl rounded-2xl overflow-hidden grid md:grid-cols-2">
        <!-- Left Side: Photo Section -->

        <!-- Right Side: Edit Form -->
        <div class="col-span-2 p-8">
            <h2 class="text-center text-3xl font-extrabold text-blue-800 mb-6">
                Edit Profil Mahasiswa
            </h2>
            
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                    <ul class="list-disc list-inside text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-4" method="POST" action="{{ route('mahasiswa.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-blue-700">Nama Lengkap</label>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ old('name', $mahasiswa->user->name) }}"
                            required 
                            class="mt-1 block w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-blue-700">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email', $mahasiswa->user->email) }}"
                            required 
                            class="mt-1 block w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        >
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-blue-700">NIM</label>
                    <input 
                        type="text" 
                        value="{{ $mahasiswa->nim }}" 
                        readonly
                        class="mt-1 block w-full rounded-md border-blue-300 bg-gray-100 cursor-not-allowed"
                    >
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-blue-700">Fakultas</label>
                        <select 
                            name="fakultas" 
                            required 
                            class="mt-1 block w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        >
                            <option value="Teknik" {{ $mahasiswa->fakultas == 'Teknik' ? 'selected' : '' }}>Teknik</option>
                            <option value="Ekonomi" {{ $mahasiswa->fakultas == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                            <option value="Hukum" {{ $mahasiswa->fakultas == 'Hukum' ? 'selected' : '' }}>Hukum</option>
                            <option value="Kedokteran" {{ $mahasiswa->fakultas == 'Kedokteran' ? 'selected' : '' }}>Kedokteran</option>
                            <option value="Pertanian" {{ $mahasiswa->fakultas == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-blue-700">Jurusan</label>
                        <select 
                            name="jurusan" 
                            required 
                            class="mt-1 block w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        >
                            <option value="Teknik Informatika" {{ $mahasiswa->jurusan == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                            <option value="Teknik Mesin" {{ $mahasiswa->jurusan == 'Teknik Mesin' ? 'selected' : '' }}>Teknik Mesin</option>
                            <option value="Akuntansi" {{ $mahasiswa->jurusan == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                            <option value="Manajemen" {{ $mahasiswa->jurusan == 'Manajemen' ? 'selected' : '' }}>Manajemen</option>
                            <option value="Ilmu Hukum" {{ $mahasiswa->jurusan == 'Ilmu Hukum' ? 'selected' : '' }}>Ilmu Hukum</option>
                            <option value="Kedokteran Umum" {{ $mahasiswa->jurusan == 'Kedokteran Umum' ? 'selected' : '' }}>Kedokteran Umum</option>
                            <option value="Agroteknologi" {{ $mahasiswa->jurusan == 'Agroteknologi' ? 'selected' : '' }}>Agroteknologi</option>
                        </select>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-blue-700">Angkatan</label>
                        <input 
                            type="number" 
                            name="angkatan" 
                            value="{{ old('angkatan', $mahasiswa->angkatan) }}"
                            required 
                            class="mt-1 block w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-blue-700">Nomor Telepon</label>
                        <input 
                            type="text" 
                            name="no_telp" 
                            value="{{ old('no_telp', $mahasiswa->user->no_telp) }}"
                            required 
                            class="mt-1 block w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        >
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-blue-700">Alamat</label>
                    <textarea 
                        name="alamat" 
                        required 
                        class="mt-1 block w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        rows="3"
                    >{{ old('alamat', $mahasiswa->user->alamat) }}</textarea>
                </div>

                <div>
                        <label class="block text-sm font-medium text-blue-700">Foto Profil</label>
                        <input 
                            type="file" 
                            name="foto" 
                            accept="image/*" 
                            class="mt-1 block w-full text-sm text-blue-700 file:mr-4 file:rounded-full file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-blue-700 hover:file:bg-blue-100"
                        >
                    </div>

                <div>
                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Perbarui Profil
                    </button>
                </div>
            </form>
        </div>
    </div>


</body>
</html>