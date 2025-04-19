<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Perpustakaanku</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .floating { 
            animation: float 6s ease-in-out infinite;
        }
        .gradient-border {
            border: double 4px transparent;
            border-radius: 0.75rem;
            background-image: linear-gradient(white, white), 
                            linear-gradient(to right, #60A5FA, #2563EB);
            background-origin: border-box;
            background-clip: padding-box, border-box;
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-50">
    <!-- Header/Navigation -->
    <nav class="p-4 bg-white/80 backdrop-blur-sm shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <!-- Logo Placeholder -->
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white">
                    <i class="fas fa-book-open text-xl"></i>
                </div>
                <div class="text-2xl font-bold text-blue-600">Perpustakaanku</div>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('welcome') }}" class="hidden md:flex items-center text-blue-600 hover:text-blue-800 transition duration-300">
                    <i class="fas fa-home mr-2"></i>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('register') }}" class="px-6 py-2 bg-white text-blue-600 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center">
                    <i class="fas fa-user-plus mr-2"></i>
                    <span>Register</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-12">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                <!-- Login Form -->
                <div class="w-full lg:w-1/2 max-w-md">
                    <div class="bg-white rounded-2xl shadow-2xl p-8 gradient-border">
                        <div class="mb-8 text-center">
                            <h1 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang Kembali!</h1>
                            <p class="text-gray-600">Silahkan masuk menggunakan akun Anda</p>
                        </div>

                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-exclamation-circle text-red-500"></i>
                                    </div>
                                    <div class="ml-3">
                                        <ul class="list-disc list-inside text-sm text-red-600">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                    </div>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                        class="block w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Masukan Email Anda">
                                </div>
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input type="password" id="password" name="password" required
                                        class="block w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Masukan Password Anda">
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input type="checkbox" id="remember" name="remember"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                                </div>
                                <a href="#" class="text-sm text-blue-600 hover:text-blue-800 transition duration-300">Lupa password?</a>
                            </div>

                            <button type="submit" 
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Masuk
                            </button>
                        </form>

                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <div class="flex items-center justify-center space-x-4">
                                <a href="#" class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center hover:bg-blue-200 transition-colors duration-300">
                                    <i class="fab fa-facebook-f text-blue-600"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center hover:bg-red-200 transition-colors duration-300">
                                    <i class="fab fa-google text-red-600"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-colors duration-300">
                                    <i class="fab fa-github text-gray-600"></i>
                                </a>
                            </div>
                            <div class="mt-6 text-center text-sm">
                                <span class="text-gray-600">Belum mempunyai akun?</span>
                                <a href="{{ route('register') }}" class="ml-1 text-blue-600 hover:text-blue-800 font-medium transition duration-300">Register here</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Illustration -->
                <div class="w-full lg:w-1/2 hidden lg:block">
                    <div class="floating relative">
                        <!-- Animated blobs -->
                        <div class="absolute top-0 right-0 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                        <div class="absolute top-0 right-8 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                        <div class="absolute -bottom-8 right-20 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
                        
                        <!-- Book illustration -->
                        <div class="relative z-10 p-8">
                            <div class="w-full max-w-lg mx-auto">
                                <div class="bg-white rounded-2xl shadow-2xl p-8 transform rotate-3">
                                    <div class="w-full h-64 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-book-reader text-white text-8xl"></i>
                                    </div>
                                    <div class="mt-6 text-center">
                                        <h3 class="text-xl font-bold text-gray-800">Perpustakaan Digital</h3>
                                        <p class="mt-2 text-gray-600">Akses ribuan buku dari berbagai kategori kapan saja dan di mana saja</p>
                                        <div class="mt-4 flex justify-center space-x-3">
                                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm font-medium">
                                                <i class="fas fa-book mr-1"></i> 10,000+ Buku
                                            </span>
                                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm font-medium">
                                                <i class="fas fa-users mr-1"></i> 5,000+ Pengguna
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white py-6 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-2 mb-4 md:mb-0">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white">
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
</body>
</html>