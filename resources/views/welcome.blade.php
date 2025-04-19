<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Welcome</title>
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
        
        .text-shadow {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-primary-50 to-primary-100 min-h-screen font-sans">
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md shadow-sm">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-lg bg-primary-600 flex items-center justify-center shadow-md">
                        
                        <img src="data:image/png;base64,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" alt="aa">
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-primary-800">Perpustakaanku</h1>
                        <p class="text-xs text-primary-600">Pusat Ilmu Pengetahuan</p>
                    </div>
                </div>
                
                <button id="mobile-menu-button" class="md:hidden text-primary-800 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{route('welcome')}}" class="text-primary-700 hover:text-primary-900 font-medium">Beranda</a>
                    <a href="{{ route('categories.all') }}" class="text-primary-700 hover:text-primary-900 font-medium">Kategori</a>
                    <a href="{{route('books.all')}}" class="text-primary-700 hover:text-primary-900 font-medium">Buku Terbaru</a>
                    <a href="{{route('about')}}" class="text-primary-700 hover:text-primary-900 font-medium">Tentang Kami</a>
                    <a href="{{route('contact')}}" class="text-primary-700 hover:text-primary-900 font-medium">Kontak</a>
                    
                    <div class="flex space-x-3 ml-4">
                        <a href="/login" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition duration-300 shadow-md">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                        <a href="/register" class="bg-white text-primary-600 px-4 py-2 rounded-lg border border-primary-600 hover:bg-primary-50 transition duration-300 shadow-sm">
                            <i class="fas fa-user-plus mr-2"></i>Register
                        </a>
                    </div>
                </div>
            </div>
            
            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-2">
                <div class="flex flex-col space-y-3">
                    <a href="#" class="text-primary-700 hover:text-primary-900 font-medium py-2 px-3 rounded-lg hover:bg-primary-50">Beranda</a>
                    <a href="#" class="text-primary-700 hover:text-primary-900 font-medium py-2 px-3 rounded-lg hover:bg-primary-50">Kategori</a>
                    <a href="#" class="text-primary-700 hover:text-primary-900 font-medium py-2 px-3 rounded-lg hover:bg-primary-50">Buku Terbaru</a>
                    <a href="#" class="text-primary-700 hover:text-primary-900 font-medium py-2 px-3 rounded-lg hover:bg-primary-50">Tentang Kami</a>
                    <a href="#" class="text-primary-700 hover:text-primary-900 font-medium py-2 px-3 rounded-lg hover:bg-primary-50">Kontak</a>
                    
                    <div class="flex flex-col space-y-2 mt-2">
                        <a href="/login" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition duration-300 text-center shadow-md">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                        <a href="/register" class="bg-white text-primary-600 px-4 py-2 rounded-lg border border-primary-600 hover:bg-primary-50 transition duration-300 text-center shadow-sm">
                            <i class="fas fa-user-plus mr-2"></i>Register
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-12 md:py-20">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="order-2 md:order-1 text-center md:text-left" data-aos="fade-right">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-primary-900 mb-6 leading-tight text-shadow">
                    Selamat Datang di <span class="text-primary-600">Perpustakaanku</span>
                </h1>
                <p class="text-xl text-primary-800 mb-8 leading-relaxed">
                    Temukan ribuan buku dari berbagai kategori dan penulis terkenal. Perluas wawasan dan pengetahuanmu bersama kami.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="/login" class="bg-primary-600 text-white px-8 py-3 rounded-full 
                        hover:bg-primary-700 transition duration-300 ease-in-out 
                        transform hover:-translate-y-1 shadow-lg flex items-center justify-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Login
                    </a>
                    <a href="/register" class="bg-white text-primary-600 px-8 py-3 rounded-full 
                        border-2 border-primary-600 hover:bg-primary-50 transition duration-300 
                        ease-in-out transform hover:-translate-y-1 shadow-md flex items-center justify-center">
                        <i class="fas fa-user-plus mr-2"></i>
                        Register
                    </a>
                </div>

                <div class="mt-12 grid grid-cols-3 gap-4">
                    <div class="text-center bg-glass p-4 rounded-xl shadow-sm">
                        <i class="fas fa-book text-3xl text-primary-600 mb-2"></i>
                        <p class="text-sm text-primary-800 font-medium">10K+ Buku</p>
                    </div>
                    <div class="text-center bg-glass p-4 rounded-xl shadow-sm">
                        <i class="fas fa-certificate text-3xl text-primary-600 mb-2"></i>
                        <p class="text-sm text-primary-800 font-medium">Terverifikasi</p>
                    </div>
                    <div class="text-center bg-glass p-4 rounded-xl shadow-sm">
                        <i class="fas fa-headset text-3xl text-primary-600 mb-2"></i>
                        <p class="text-sm text-primary-800 font-medium">Dukungan 24/7</p>
                    </div>
                </div>
            </div>

            <div class="order-1 md:order-2 relative" data-aos="fade-left">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary-300 rounded-full opacity-30 blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-primary-400 rounded-full opacity-30 blur-2xl"></div>
                <img src="https://cdni.iconscout.com/illustration/premium/thumb/library-book-shelf-5472825-4569550.png" 
                     alt="Library 3D Illustration" 
                     class="w-full h-auto transform hover:scale-105 transition-transform duration-500 rounded-2xl shadow-2xl relative z-10">
                <div class="absolute -bottom-4 right-4 bg-white p-3 rounded-xl shadow-lg z-20 flex items-center space-x-2" data-aos="fade-up" data-aos-delay="300">
                    <i class="fas fa-users text-primary-600"></i>
                    <div>
                        <p class="text-xs text-primary-600">Anggota Aktif</p>
                        <p class="text-lg font-bold text-primary-900">5,000+</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10">
            <div data-aos="fade-right">
                <h2 class="text-3xl font-bold text-primary-900 mb-2">Kategori Buku</h2>
                <p class="text-primary-600">Temukan buku berdasarkan kategori yang kamu minati</p>
            </div>
            <a href="{{ route('categories.all') }}" class="mt-4 md:mt-0 text-primary-600 hover:text-primary-800 transition-colors duration-300 flex items-center gap-2 group" data-aos="fade-left">
                <span>Lihat Semua Kategori</span>
                <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6" data-aos="fade-up" data-aos-delay="200">
            @foreach($kategoris as $kategori)
            <a href="{{ route('category.books', $kategori->id) }}" class="group">
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 text-center group-hover:bg-primary-50 border border-transparent group-hover:border-primary-200 h-full flex flex-col justify-between">
                    <div class="mb-4">
                        <div class="w-16 h-16 mx-auto mb-4 bg-primary-100 rounded-full flex items-center justify-center group-hover:bg-primary-200 transition-colors duration-300">
                            @switch($loop->index % 5)
                                @case(0)
                                    <i class="fas fa-book text-2xl text-primary-600"></i>
                                    @break
                                @case(1)
                                    <i class="fas fa-flask text-2xl text-primary-600"></i>
                                    @break
                                @case(2)
                                    <i class="fas fa-landmark text-2xl text-primary-600"></i>
                                    @break
                                @case(3)
                                    <i class="fas fa-code text-2xl text-primary-600"></i>
                                    @break
                                @default
                                    <i class="fas fa-paint-brush text-2xl text-primary-600"></i>
                            @endswitch
                        </div>
                        <h3 class="text-lg font-semibold text-primary-800 group-hover:text-primary-600">{{ $kategori->nama }}</h3>
                    </div>
                    <p class="text-primary-600/70 mt-2 text-sm">{{ $kategori->deskripsi ?? 'Jelajahi koleksi buku kami' }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <div class="container mx-auto px-4 py-16 bg-white/50 rounded-3xl my-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10">
            <div data-aos="fade-right">
                <h2 class="text-3xl font-bold text-primary-900 mb-2">Buku Terbaru</h2>
                <p class="text-primary-600">Koleksi terbaru yang baru saja ditambahkan</p>
            </div>
            <a href="{{ route('books.all') }}" class="mt-4 md:mt-0 text-primary-600 hover:text-primary-800 transition-colors duration-300 flex items-center gap-2 group" data-aos="fade-left">
                <span>Lihat Semua Buku</span>
                <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($buku_terbaru as $buku)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 group" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="relative h-56 overflow-hidden">
                    <div class="absolute top-3 right-3 bg-primary-600 text-white text-xs font-bold px-2 py-1 rounded-full z-10">Baru</div>
                    <img src="{{ Storage::url($buku->foto) }}" alt="{{ $buku->judul }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                        <div class="p-4 w-full">
                            <a href="#" class="w-full bg-white text-primary-600 px-4 py-2 rounded-lg hover:bg-primary-50 transition-colors duration-300 flex items-center justify-center font-medium">
                                <i class="fas fa-eye mr-2"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-3">
                        @foreach($buku->kategoris as $kategori)
                        <span class="text-xs font-medium bg-primary-100 text-primary-800 px-2 py-1 rounded-full">{{ $kategori->nama }}</span>
                        @endforeach
                    </div>
                    <h3 class="text-xl font-bold text-primary-900 mb-2 line-clamp-1">{{ $buku->judul }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-2 text-sm">{{ $buku->deskripsi ?? 'Deskripsi buku tidak tersedia.' }}</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <i class="fas fa-user-edit text-primary-500 mr-2"></i>
                            <span class="text-primary-600 font-medium">{{ $buku->penulis }}</span>
                        </div>
                        <div class="flex items-center text-amber-500">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-md text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 mx-auto mb-4 bg-primary-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-book-open text-2xl text-primary-600"></i>
                </div>
                <h3 class="text-3xl font-bold text-primary-900 mb-2">10K+</h3>
                <p class="text-primary-600">Total Buku</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 mx-auto mb-4 bg-primary-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-2xl text-primary-600"></i>
                </div>
                <h3 class="text-3xl font-bold text-primary-900 mb-2">5K+</h3>
                <p class="text-primary-600">Anggota Aktif</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 mx-auto mb-4 bg-primary-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-exchange-alt text-2xl text-primary-600"></i>
                </div>
                <h3 class="text-3xl font-bold text-primary-900 mb-2">50K+</h3>
                <p class="text-primary-600">Peminjaman</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md text-center" data-aos="fade-up" data-aos-delay="400">
                <div class="w-16 h-16 mx-auto mb-4 bg-primary-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-award text-2xl text-primary-600"></i>
                </div>
                <h3 class="text-3xl font-bold text-primary-900 mb-2">15+</h3>
                <p class="text-primary-600">Tahun Pengalaman</p>
            </div>
        </div>
    </div>

    <footer class="bg-primary-950 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-5 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 rounded-lg bg-primary-600 flex items-center justify-center shadow-md">
                            <img src="data:image/png;base64,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" alt="aaaa">
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-white">Perpustakaanku</h1>
                            <p class="text-xs text-primary-300">Pusat Ilmu Pengetahuan</p>
                        </div>
                    </div>
                    <p class="text-primary-200 mb-6">Menyediakan akses mudah ke berbagai koleksi buku untuk semua kalangan. Kami berkomitmen untuk menyebarkan ilmu pengetahuan dan meningkatkan literasi masyarakat.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-primary-800 flex items-center justify-center hover:bg-primary-700 transition-colors duration-300">
                            <i class="fab fa-facebook-f text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-primary-800 flex items-center justify-center hover:bg-primary-700 transition-colors duration-300">
                            <i class="fab fa-twitter text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-primary-800 flex items-center justify-center hover:bg-primary-700 transition-colors duration-300">
                            <i class="fab fa-instagram text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-primary-800 flex items-center justify-center hover:bg-primary-700 transition-colors duration-300">
                            <i class="fab fa-youtube text-white"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-6 text-white">Kategori</h4>
                    <ul class="space-y-3">
                        @foreach($kategoris->take(5) as $kategori)
                        <li>
                            <a href="{{ route('category.books', $kategori->id) }}" class="text-primary-200 hover:text-white transition-colors duration-300 flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2 text-primary-400"></i>
                                {{ $kategori->nama }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-6 text-white">Layanan</h4>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="text-primary-200 hover:text-white transition-colors duration-300 flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2 text-primary-400"></i>
                                Peminjaman
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-primary-200 hover:text-white transition-colors duration-300 flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2 text-primary-400"></i>
                                Perpanjangan
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-primary-200 hover:text-white transition-colors duration-300 flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2 text-primary-400"></i>
                                Pencarian Buku
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-primary-200 hover:text-white transition-colors duration-300 flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2 text-primary-400"></i>
                                Keanggotaan
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-primary-200 hover:text-white transition-colors duration-300 flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2 text-primary-400"></i>
                                Bantuan Online
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-6 text-white">Kontak</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt text-primary-400 mt-1"></i>
                            <span class="text-primary-200">Jalan Buku No. 123, Kota Literasi, 12345</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-envelope text-primary-400 mt-1"></i>
                            <span class="text-primary-200">info@perpustakaanku.com</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-phone-alt text-primary-400 mt-1"></i>
                            <span class="text-primary-200">+62 123 456 789</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-clock text-primary-400 mt-1"></i>
                            <span class="text-primary-200">Senin - Jumat: 08:00 - 20:00<br>Sabtu: 09:00 - 17:00</span>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="border-primary-800 my-10">
            <div class="flex flex-col md:flex-row justify-between items-center text-primary-300 text-sm">
                <p>&copy; 2025 Perpustakaanku. Hak Cipta Dilindungi.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition-colors duration-300">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-white transition-colors duration-300">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-white transition-colors duration-300">FAQ</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
        
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>