<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 via-blue-200 to-blue-300 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl w-full bg-white shadow-2xl rounded-2xl overflow-hidden">
        <div class="grid md:grid-cols-2">
            <!-- Left Side: Model Photo Section -->
            <div class="col-span-2 p-8">
                <h2 class="text-center text-3xl font-extrabold text-blue-800 mb-6">
                    Registrasi Mahasiswa
                </h2>
                
                <form class="space-y-4" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-blue-700">Nama Lengkap</label>
                            <input 
                                type="text" 
                                name="name" 
                                required 
                                class="mt-1 block w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-blue-700">Email</label>
                            <input 
                                type="email" 
                                name="email" 
                                required 
                                class="mt-1 block w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                            >
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-blue-700">Password</label>
                            <input 
                                type="password" 
                                name="password" 
                                required 
                                class="mt-1 block w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-blue-700">Konfirmasi Password</label>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                required 
                                class="mt-1 block w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                            >
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-blue-700">NIM</label>
                            <input 
                                type="text" 
                                name="nim" 
                                required 
                                class="mt-1 block w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-blue-700">Jenis Kelamin</label>
                            <select 
                                name="jenis_kelamin" 
                                required 
                                class="mt-1 block w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                            >
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-blue-700">Fakultas</label>
                            <select 
                                name="fakultas" 
                                required 
                                class="mt-1 block w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                            >
                                <option value="">Pilih Fakultas</option>
                                <option value="Teknik">Teknik</option>
                                <option value="Ekonomi">Ekonomi</option>
                                <option value="Hukum">Hukum</option>
                                <option value="Kedokteran">Kedokteran</option>
                                <option value="Pertanian">Pertanian</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-blue-700">Jurusan</label>
                            <select 
                                name="jurusan" 
                                required 
                                class="mt-1 block w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                            >
                                <option value="">Pilih Jurusan</option>
                                <option value="Teknik Informatika">Teknik Informatika</option>
                                <option value="Teknik Mesin">Teknik Mesin</option>
                                <option value="Akuntansi">Akuntansi</option>
                                <option value="Manajemen">Manajemen</option>
                                <option value="Ilmu Hukum">Ilmu Hukum</option>
                                <option value="Kedokteran Umum">Kedokteran Umum</option>
                                <option value="Agroteknologi">Agroteknologi</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-blue-700">Tanggal Lahir</label>
                            <input 
                                type="date" 
                                name="tanggal_lahir" 
                                required 
                                class="mt-1 block w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-blue-700">Angkatan</label>
                            <input 
                                type="number" 
                                name="angkatan" 
                                required 
                                min="2000" 
                                max="{{ date('Y') }}"
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
                        ></textarea>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-blue-700">Nomor Telepon</label>
                            <input 
                                type="text" 
                                name="no_telp" 
                                required 
                                class="mt-1 block w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                            >
                        </div>
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
                            Registrasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
            
        <!-- Error Display -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 p-4">
                <div class="flex">
                    <div class="ml-3">
                        <ul class="list-disc list-inside text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
</body>
</html>