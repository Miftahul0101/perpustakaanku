<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Perpustakaanku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-border {
            border: double 4px transparent;
            border-radius: 0.75rem;
            background-image: linear-gradient(white, white), 
                            linear-gradient(to right, #60A5FA, #2563EB);
            background-origin: border-box;
            background-clip: padding-box, border-box;
        }
        
        .step-active {
            background-color: #2563EB;
            color: white;
        }
        
        .step-completed {
            background-color: #93C5FD;
            color: #1E40AF;
        }
        
        .step-inactive {
            background-color: #E5E7EB;
            color: #6B7280;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-blue-50 min-h-screen">
    <!-- Header/Navigation -->
    <nav class="p-4 bg-white/80 backdrop-blur-sm shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <!-- Logo Placeholder -->
                <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white shadow-md">
                    <i class="fas fa-book-open text-xl"></i>
                </div>
                <div class="text-2xl font-bold text-blue-600">Perpustakaanku</div>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('welcome') }}" class="hidden md:flex items-center text-blue-600 hover:text-blue-800 transition duration-300">
                    <i class="fas fa-home mr-2"></i>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('login') }}" class="px-6 py-2 bg-white text-blue-600 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    <span>Login</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <!-- Registration Form -->
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden gradient-border mb-8">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 text-white">
                    <h2 class="text-3xl font-bold text-center">Registrasi Mahasiswa</h2>
                    <p class="text-center text-blue-100 mt-2">Bergabunglah dengan perpustakaan digital kami</p>
                </div>
                
                
                <!-- Error Display -->
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 m-6 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Terdapat beberapa kesalahan:</h3>
                                <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                
                <form class="p-6 md:p-8" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Personal Information -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-blue-800 mb-4 flex items-center">
                            <i class="fas fa-user-circle mr-2"></i>
                            Informasi Pribadi
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-blue-700 mb-2">
                                    <i class="fas fa-user mr-2"></i>
                                    Nama Lengkap
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        value="{{ old('name') }}"
                                        required 
                                        class="pl-10 pr-4 py-3 w-full rounded-lg border border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                        placeholder="Masukkan nama lengkap"
                                    >
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-blue-700 mb-2">
                                    <i class="fas fa-envelope mr-2"></i>
                                    Email
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        value="{{ old('email') }}"
                                        required 
                                        class="pl-10 pr-4 py-3 w-full rounded-lg border border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                        placeholder="Masukkan alamat email"
                                    >
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-blue-700 mb-2">
                                    <i class="fas fa-lock mr-2"></i>
                                    Password
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="password" 
                                        name="password" 
                                        required 
                                        class="pl-10 pr-10 py-3 w-full rounded-lg border border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                        placeholder="Masukkan password"
                                    >
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer toggle-password">
                                        <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                                    </div>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Password minimal 8 karakter</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-blue-700 mb-2">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Konfirmasi Password
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="password" 
                                        name="password_confirmation" 
                                        required 
                                        class="pl-10 pr-10 py-3 w-full rounded-lg border border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                        placeholder="Konfirmasi password"
                                    >
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer toggle-password">
                                        <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Academic Information -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-blue-800 mb-4 flex items-center">
                            <i class="fas fa-graduation-cap mr-2"></i>
                            Informasi Akademik
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-blue-700 mb-2">
                                    <i class="fas fa-id-card mr-2"></i>
                                    NIM
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-id-card text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        name="nim" 
                                        value="{{ old('nim') }}"
                                        required 
                                        class="pl-10 pr-4 py-3 w-full rounded-lg border border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                        placeholder="Masukkan NIM"
                                    >
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-blue-700 mb-2">
                                    <i class="fas fa-venus-mars mr-2"></i>
                                    Jenis Kelamin
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-venus-mars text-gray-400"></i>
                                    </div>
                                    <select 
                                        name="jenis_kelamin" 
                                        required 
                                        class="pl-10 pr-10 py-3 w-full rounded-lg border border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 appearance-none"
                                    >
                                        <option value="" {{ old('jenis_kelamin') ? '' : 'selected' }} disabled>Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-blue-700 mb-2">
                                    <i class="fas fa-university mr-2"></i>
                                    Fakultas
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-university text-gray-400"></i>
                                    </div>
                                    <select 
                                        name="fakultas" 
                                        id="fakultas"
                                        required 
                                        class="pl-10 pr-10 py-3 w-full rounded-lg border border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 appearance-none"
                                    >
                                        <option value="" {{ old('fakultas') ? '' : 'selected' }} disabled>Pilih Fakultas</option>
                                        <option value="Teknik" {{ old('fakultas') == 'Teknik' ? 'selected' : '' }}>Teknik</option>
                                        <option value="Ekonomi" {{ old('fakultas') == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                                        <option value="Hukum" {{ old('fakultas') == 'Hukum' ? 'selected' : '' }}>Hukum</option>
                                        <option value="Kedokteran" {{ old('fakultas') == 'Kedokteran' ? 'selected' : '' }}>Kedokteran</option>
                                        <option value="Pertanian" {{ old('fakultas') == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-blue-700 mb-2">
                                    <i class="fas fa-book mr-2"></i>
                                    Jurusan
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-book text-gray-400"></i>
                                    </div>
                                    <select 
                                        name="jurusan" 
                                        id="jurusan"
                                        required 
                                        class="pl-10 pr-10 py-3 w-full rounded-lg border border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 appearance-none"
                                    >
                                        <option value="" {{ old('jurusan') ? '' : 'selected' }} disabled>Pilih Jurusan</option>
                                        <option value="Teknik Informatika" {{ old('jurusan') == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                                        <option value="Teknik Mesin" {{ old('jurusan') == 'Teknik Mesin' ? 'selected' : '' }}>Teknik Mesin</option>
                                        <option value="Akuntansi" {{ old('jurusan') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                                        <option value="Manajemen" {{ old('jurusan') == 'Manajemen' ? 'selected' : '' }}>Manajemen</option>
                                        <option value="Ilmu Hukum" {{ old('jurusan') == 'Ilmu Hukum' ? 'selected' : '' }}>Ilmu Hukum</option>
                                        <option value="Kedokteran Umum" {{ old('jurusan') == 'Kedokteran Umum' ? 'selected' : '' }}>Kedokteran Umum</option>
                                        <option value="Agroteknologi" {{ old('jurusan') == 'Agroteknologi' ? 'selected' : '' }}>Agroteknologi</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-blue-700 mb-2">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    Tanggal Lahir
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-calendar-alt text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="date" 
                                        name="tanggal_lahir" 
                                        value="{{ old('tanggal_lahir') }}"
                                        required 
                                        class="pl-10 pr-4 py-3 w-full rounded-lg border border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                    >
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-blue-700 mb-2">
                                    <i class="fas fa-user-graduate mr-2"></i>
                                    Angkatan
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user-graduate text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="number" 
                                        name="angkatan" 
                                        value="{{ old('angkatan') }}"
                                        required 
                                        min="2000" 
                                        max="{{ date('Y') }}"
                                        class="pl-10 pr-4 py-3 w-full rounded-lg border border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                        placeholder="Masukkan tahun angkatan"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contact Information -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-blue-800 mb-4 flex items-center">
                            <i class="fas fa-address-card mr-2"></i>
                            Informasi Kontak
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-blue-700 mb-2">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    Alamat
                                </label>
                                <div class="relative">
                                    <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                                    </div>
                                    <textarea 
                                        name="alamat" 
                                        required 
                                        class="pl-10 pr-4 py-3 w-full rounded-lg border border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                        rows="3"
                                        placeholder="Masukkan alamat lengkap"
                                    >{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-blue-700 mb-2">
                                    <i class="fas fa-phone mr-2"></i>
                                    Nomor Telepon
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-phone text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        name="no_telp" 
                                        value="{{ old('no_telp') }}"
                                        required 
                                        class="pl-10 pr-4 py-3 w-full rounded-lg border border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                        placeholder="Masukkan nomor telepon"
                                    >
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-blue-700 mb-2">
                                    <i class="fas fa-image mr-2"></i>
                                    Foto Profil
                                </label>
                                <div class="relative">
                                    <div class="flex items-center">
                                        <label class="w-full flex flex-col items-center px-4 py-3 bg-white text-blue-600 rounded-lg border border-blue-300 shadow-sm tracking-wide cursor-pointer hover:bg-blue-50 transition-colors duration-300">
                                            <i class="fas fa-cloud-upload-alt text-xl mb-2"></i>
                                            <span class="text-sm leading-normal">Pilih foto</span>
                                            <input 
                                                type="file" 
                                                name="foto" 
                                                accept="image/*" 
                                                class="hidden"
                                            >
                                        </label>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG. Maks: 2MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Terms and Conditions -->
                    <div class="mb-8">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input 
                                    id="terms" 
                                    name="terms" 
                                    type="checkbox" 
                                    required
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                >
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-medium text-gray-700">Saya menyetujui <a href="#" class="text-blue-600 hover:underline">syarat dan ketentuan</a> yang berlaku</label>
                                <p class="text-gray-500">Dengan mendaftar, Anda setuju untuk mematuhi peraturan perpustakaan.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div>
                        <button 
                            type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300"
                        >
                            <i class="fas fa-user-plus mr-2"></i>
                            Daftar Sekarang
                        </button>
                    </div>
                    
                    <div class="mt-6 text-center text-sm">
                        <span class="text-gray-600">Sudah memiliki akun?</span>
                        <a href="{{ route('login') }}" class="ml-1 text-blue-600 hover:text-blue-800 font-medium transition duration-300">Login di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-white py-6 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-2 mb-4 md:mb-0">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <span class="text-gray-600">&copy; 2023 Perpustakaanku. All rights reserved.</span>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-500 hover:text-blue-600 transition duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-blue-600 transition duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-blue-600 transition duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-blue-600 transition duration-300">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    
    <script>
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(function(element) {
            element.addEventListener('click', function() {
                const passwordInput = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
        
        // Dynamic jurusan based on fakultas
        document.getElementById('fakultas').addEventListener('change', function() {
            const fakultas = this.value;
            const jurusanSelect = document.getElementById('jurusan');
            
            // Clear current options
            jurusanSelect.innerHTML = '<option value="" disabled selected>Pilih Jurusan</option>';
            
            // Add options based on selected fakultas
            if (fakultas === 'Teknik') {
                addOption(jurusanSelect, 'Teknik Informatika', 'Teknik Informatika');
                addOption(jurusanSelect, 'Teknik Mesin', 'Teknik Mesin');
                addOption(jurusanSelect, 'Teknik Elektro', 'Teknik Elektro');
                addOption(jurusanSelect, 'Teknik Sipil', 'Teknik Sipil');
            } else if (fakultas === 'Ekonomi') {
                addOption(jurusanSelect, 'Akuntansi', 'Akuntansi');
                addOption(jurusanSelect, 'Manajemen', 'Manajemen');
                addOption(jurusanSelect, 'Ekonomi Pembangunan', 'Ekonomi Pembangunan');
            } else if (fakultas === 'Hukum') {
                addOption(jurusanSelect, 'Ilmu Hukum', 'Ilmu Hukum');
            } else if (fakultas === 'Kedokteran') {
                addOption(jurusanSelect, 'Kedokteran Umum', 'Kedokteran Umum');
                addOption(jurusanSelect, 'Kedokteran Gigi', 'Kedokteran Gigi');
            } else if (fakultas === 'Pertanian') {
                addOption(jurusanSelect, 'Agroteknologi', 'Agroteknologi');
                addOption(jurusanSelect, 'Agribisnis', 'Agribisnis');
            }
        });
        
        function addOption(selectElement, value, text) {
            const option = document.createElement('option');
            option.value = value;
            option.textContent = text;
            selectElement.appendChild(option);
        }
    </script>
</body>
</html>