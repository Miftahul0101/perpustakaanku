<!DOCTYPE html>
<html>
<head>
    <title>Register Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/spltjs/1.4.0/splt.min.js"></script>
    <style>
        .gradient-animation {
            background: linear-gradient(270deg, #1e40af, #3b82f6, #60a5fa);
            background-size: 600% 600%;
            animation: gradientShift 12s ease infinite;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50% }
            50% { background-position: 100% 50% }
            100% { background-position: 0% 50% }
        }
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="md:flex">
                <div class="md:w-2/5 gradient-animation p-8 text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <h2 class="text-4xl font-bold mb-6">Selamat Datang di Perpustakaanku!</h2>
                        <p class="text-lg mb-6 text-blue-100">Info seputar buku dan peminjaman dalam perpustakaanku.</p>
                        @if ($errors->any())
    <div class="bg-red-100 text-red-500 p-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                        <!-- 3D-like floating elements -->
                        <div class="floating mt-12">
                            <div class="w-24 h-24 bg-white/10 backdrop-blur-lg rounded-2xl shadow-lg transform rotate-12 relative mx-auto">
                                <div class="absolute inset-0 bg-blue-500/40 rounded-2xl transform -rotate-12 flex items-center justify-center backdrop-blur-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Background decorative elements -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-400/20 rounded-full -mr-16 -mt-16 backdrop-blur-lg"></div>
                    <div class="absolute bottom-0 left-0 w-40 h-40 bg-blue-300/20 rounded-full -ml-20 -mb-20 backdrop-blur-lg"></div>
                </div>
                
                <div class="md:w-3/5 p-8">
                    <h2 class="text-3xl font-bold mb-6 text-gray-800">Pendaftaran Keanggotaan Perpustakaanku</h2>
                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                                <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                                <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">NIM</label>
                            <input type="text" name="nim" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Jurusan</label>
                                <select name="jurusan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required>
                                    <option value="">Pilih Jurusan</option>
                                    <option value="RPL">Rekayasa Perangkat Lunak</option>
                                    <option value="TI">Teknik Informatika</option>
                                    <option value="SI">Sistem Informasi</option>
                                    <option value="MI">Manajemen Informatika</option>
                                    <option value="KA">Komputerisasi Akuntansi</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Fakultas</label>
                                <select name="fakultas" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required>
                                    <option value="">Pilih Fakultas</option>
                                    <option value="FTI">Fakultas Teknologi Informasi</option>
                                    <option value="FE">Fakultas Ekonomi</option>
                                    <option value="FT">Fakultas Teknik</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Angkatan</label>
                                <select name="angkatan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required>
                                    <option value="">Pilih Angkatan</option>
                                    <option value="2000">Fakultas Teknologi Informasi</option>
                                    <option value="2000">Fakultas Ekonomi</option>
                                    <option value="2000">Fakultas Teknik</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required>
                            <script>
                                const birthDateInput = document.querySelector('input[name="tanggal_lahir"]');
                                const today = new Date();
                                const minDate = new Date(today.getFullYear() - 17, today.getMonth(), today.getDate());
                                birthDateInput.max = minDate.toISOString().split('T')[0];
                            </script>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
                            <textarea name="alamat" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" rows="3" required></textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">No. Telepon</label>
                            <input type="tel" name="no_telp" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required pattern="[0-9]{10,13}" title="Please enter a valid phone number (10-13 digits)">
                        </div>

                        <div>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="foto">
            Foto
        </label>
        <input 
            type="file" 
            name="foto" 
            id="foto"
            accept="image/jpeg,image/png,image/jpg,image/gif"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
        >
        @error('foto')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
                    
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Register Now
                        </button>
                    </form>

                    <p class="mt-6 text-center text-gray-600">
                        Sudah mendaftar? 
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold transition duration-300">Masuk Disini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>