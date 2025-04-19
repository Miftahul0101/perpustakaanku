<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaanku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                            950: '#082f49',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        .bg-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        [x-cloak] { display: none !important; }
        
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-primary-50 to-primary-100 min-h-screen font-sans">
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md shadow-sm">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-3">
                <!-- Logo Area -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('welcome') }}" class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-primary-600 flex items-center justify-center shadow-md">
<img src="data:image/png;base64,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" alt="aa">
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-primary-800">Perpustakaanku</h1>
                            <p class="text-xs text-primary-600 hidden sm:block">Pusat Ilmu Pengetahuan</p>
                        </div>
                    </a>
                </div>
                
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('welcome') }}" class="text-primary-700 hover:text-primary-900 font-medium transition-colors duration-300 flex items-center space-x-1">
                        <i class="fas fa-home text-sm"></i>
                        <span>Beranda</span>
                    </a>
                    <a href="{{ route('books.all') }}" class="text-primary-700 hover:text-primary-900 font-medium transition-colors duration-300 flex items-center space-x-1">
                        <i class="fas fa-book text-sm"></i>
                        <span>Buku</span>
                    </a>
                    <a href="{{ route('categories.all') }}" class="text-primary-700 hover:text-primary-900 font-medium transition-colors duration-300 flex items-center space-x-1">
                        <i class="fas fa-th-large text-sm"></i>
                        <span>Kategori</span>
                    </a>
                    <a href="{{route('contact')}}" class="text-primary-700 hover:text-primary-900 font-medium transition-colors duration-300 flex items-center space-x-1">
                        <i class="fas fa-phone text-sm"></i>
                        <span>Kontak</span>
                    </a>
                    <a href="{{route('about')}}" class="text-primary-700 hover:text-primary-900 font-medium transition-colors duration-300 flex items-center space-x-1">
                        <i class="fas fa-info text-sm"></i>
                        <span>Tentang</span>
                    </a>
                </div>
                
                <!-- Auth Buttons -->
                <div class="hidden sm:flex items-center space-x-3">
                    <a href="/login" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors duration-300 flex items-center space-x-1 shadow-sm">
                        <i class="fas fa-sign-in-alt text-sm"></i>
                        <span>Login</span>
                    </a>
                    <a href="/register" class="border border-primary-600 text-primary-600 px-4 py-2 rounded-lg hover:bg-primary-50 transition-colors duration-300 flex items-center space-x-1">
                        <i class="fas fa-user-plus text-sm"></i>
                        <span>Register</span>
                    </a>
                </div>
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden text-primary-800 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
            
            <!-- Mobile Navigation (Hidden by default) -->
            <div id="mobile-menu" class="hidden md:hidden py-4 border-t border-primary-100">
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('welcome') }}" class="text-primary-700 hover:text-primary-900 font-medium py-2 px-3 rounded-lg hover:bg-primary-50 flex items-center space-x-2">
                        <i class="fas fa-home w-5 text-center"></i>
                        <span>Beranda</span>
                    </a>
                    <a href="{{ route('books.all') }}" class="text-primary-700 hover:text-primary-900 font-medium py-2 px-3 rounded-lg hover:bg-primary-50 flex items-center space-x-2">
                        <i class="fas fa-book w-5 text-center"></i>
                        <span>Buku</span>
                    </a>
                    <a href="{{ route('categories.all') }}" class="text-primary-700 hover:text-primary-900 font-medium py-2 px-3 rounded-lg hover:bg-primary-50 flex items-center space-x-2">
                        <i class="fas fa-th-large w-5 text-center"></i>
                        <span>Kategori</span>
                    </a>
                    
                    <div class="flex space-x-2 pt-2 border-t border-primary-100 mt-2">
                        <a href="/login" class="flex-1 bg-primary-600 text-white py-2 rounded-lg hover:bg-primary-700 transition-colors duration-300 text-center flex items-center justify-center space-x-1">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Login</span>
                        </a>
                        <a href="/register" class="flex-1 bg-white text-primary-600 py-2 rounded-lg border border-primary-600 hover:bg-primary-50 transition-colors duration-300 text-center flex items-center justify-center space-x-1">
                            <i class="fas fa-user-plus"></i>
                            <span>Register</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="bg-primary-700 text-white py-6 mb-8 shadow-md">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl md:text-3xl font-bold">@yield('page-title', 'Perpustakaanku')</h1>
            @hasSection('page-subtitle')
                <p class="text-primary-100 mt-2">@yield('page-subtitle')</p>
            @endif
            
            <!-- Breadcrumbs -->
            @hasSection('breadcrumbs')
                <div class="flex items-center space-x-2 text-sm mt-4 text-primary-200">
                    @yield('breadcrumbs')
                </div>
            @endif
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-4 pb-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-primary-950 text-white py-12 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 rounded-lg bg-primary-600 flex items-center justify-center">
                        <img src="data:image/png;base64,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" alt="aa">
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">Perpustakaanku</h3>
                            <p class="text-xs text-primary-300">Pusat Ilmu Pengetahuan</p>
                        </div>
                    </div>
                    <p class="text-primary-300 mb-4">Menyediakan akses mudah ke berbagai koleksi buku untuk semua kalangan. Kami berkomitmen untuk menyebarkan ilmu pengetahuan dan meningkatkan literasi masyarakat.</p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-8 h-8 rounded-full bg-primary-800 flex items-center justify-center hover:bg-primary-700 transition-colors duration-300">
                            <i class="fab fa-facebook-f text-white text-sm"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-primary-800 flex items-center justify-center hover:bg-primary-700 transition-colors duration-300">
                            <i class="fab fa-twitter text-white text-sm"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-primary-800 flex items-center justify-center hover:bg-primary-700 transition-colors duration-300">
                            <i class="fab fa-instagram text-white text-sm"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Tautan</h4>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('welcome') }}" class="text-primary-300 hover:text-white transition-colors duration-300 flex items-center space-x-2">
                                <i class="fas fa-chevron-right text-xs"></i>
                                <span>Beranda</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('books.all') }}" class="text-primary-300 hover:text-white transition-colors duration-300 flex items-center space-x-2">
                                <i class="fas fa-chevron-right text-xs"></i>
                                <span>Semua Buku</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('categories.all') }}" class="text-primary-300 hover:text-white transition-colors duration-300 flex items-center space-x-2">
                                <i class="fas fa-chevron-right text-xs"></i>
                                <span>Kategori</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-map-marker-alt text-primary-400 mt-1"></i>
                            <span class="text-primary-300">Jalan Buku No. 123, Kota Literasi, 12345</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-envelope text-primary-400 mt-1"></i>
                            <span class="text-primary-300">info@perpustakaanku.com</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-phone text-primary-400 mt-1"></i>
                            <span class="text-primary-300">+62 123 456 789</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-primary-800 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-primary-400 text-sm">&copy; 2025 Perpustakaanku. Hak Cipta Dilindungi.</p>
                <div class="flex space-x-4 mt-4 md:mt-0 text-sm">
                    <a href="#" class="text-primary-400 hover:text-white transition-colors duration-300">Syarat & Ketentuan</a>
                    <a href="#" class="text-primary-400 hover:text-white transition-colors duration-300">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- AOS and Optional JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });
        
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>