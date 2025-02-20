<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaanku</title>
    
    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    
    <style>
        .nav-item {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .nav-item::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #93C5FD;
            transition: width 0.3s ease;
        }
        
        .nav-item:hover::after {
            width: 100%;
        }
        
        .sidebar-animation {
            animation: slideIn 0.5s ease-out;
        }
        
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        
        .hover-scale {
            transition: transform 0.2s ease;
        }
        
        .hover-scale:hover {
            transform: scale(1.02);
        }
        
        .gradient-text {
            background: linear-gradient(45deg, #60A5FA, #93C5FD);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Mobile Menu Button -->
        <div class="lg:hidden fixed top-4 left-4 z-50">
            <button id="mobile-menu-button" class="p-3 rounded-lg bg-white shadow-md text-blue-500 focus:outline-none hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                <i class="ph-list-bold text-xl"></i>
            </button>
        </div>

        <!-- Modern Sidebar -->
        <div id="sidebar" class="fixed left-0 top-0 w-72 h-full transform -translate-x-full lg:translate-x-0 transition-all duration-300 ease-in-out z-40 sidebar-animation">
            <div class="h-full bg-white shadow-xl">
                <!-- Modern Logo/Brand -->
                <div class="flex items-center justify-center h-20 border-b border-gray-100">
                    <span class="text-blue-500 text-2xl font-bold tracking-wider hover-scale">
                        <i class="ph-books-bold text-3xl mr-2"></i>Perpustakaanku
                    </span>
                </div>

                <!-- Enhanced Navigation -->
                <nav class="mt-8 px-6">
                    <div class="space-y-2">
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center space-x-4 text-gray-700 py-3 px-4 rounded-xl transition-all hover:bg-blue-50 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : '' }}">
                                <i class="ph-chart-pie-bold text-2xl"></i>
                                <span class="font-medium">Dashboard</span>
                            </a>
                            <a href="{{ route('adminmahasiswa.index') }}" class="nav-item flex items-center space-x-4 text-gray-700 py-3 px-4 rounded-xl transition-all hover:bg-blue-50 {{ request()->routeIs('users.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                                <i class="ph-student-bold text-2xl"></i>
                                <span class="font-medium">Data Mahasiswa</span>
                            </a>
                            <a href="{{ route('users.index') }}" class="nav-item flex items-center space-x-4 text-gray-700 py-3 px-4 rounded-xl transition-all hover:bg-blue-50 {{ request()->routeIs('users.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                                <i class="ph-users-bold text-2xl"></i>
                                <span class="font-medium">Data Admin/Petugas</span>
                            </a>
                        @elseif(auth()->user()->role === 'petugas')
                            <a href="{{ route('petugas.dashboard') }}" class="nav-item flex items-center space-x-4 text-gray-700 py-3 px-4 rounded-xl transition-all hover:bg-blue-50 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : '' }}">
                                <i class="ph-chart-pie-bold text-2xl"></i>
                                <span class="font-medium">Dashboard</span>
                            </a>
                            <a href="{{ route('buku.index') }}" class="nav-item flex items-center space-x-4 text-gray-700 py-3 px-4 rounded-xl transition-all hover:bg-blue-50 {{ request()->routeIs('buku.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                                <i class="ph-book-bookmark-bold text-2xl"></i>
                                <span class="font-medium">Buku</span>
                            </a>
                        @else
                            <a href="{{ route('mahasiswa.dashboard') }}" class="nav-item flex items-center space-x-4 text-gray-700 py-3 px-4 rounded-xl transition-all hover:bg-blue-50 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : '' }}">
                                <i class="ph-chart-pie-bold text-2xl"></i>
                                <span class="font-medium">Dashboard</span>
                            </a>
                            <a href="{{ route('mahasiswa.index') }}" class="nav-item flex items-center space-x-4 text-gray-700 py-3 px-4 rounded-xl transition-all hover:bg-blue-50 {{ request()->routeIs('peminjaman.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                                <i class="ph-books-bold text-2xl"></i>
                                <span class="font-medium">Profile</span>
                            </a>
                            <a href="" class="nav-item flex items-center space-x-4 text-gray-700 py-3 px-4 rounded-xl transition-all hover:bg-blue-50 {{ request()->routeIs('riwayat.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                                <i class="ph-clock-countdown-bold text-2xl"></i>
                                <span class="font-medium">Riwayat</span>
                            </a>
                            <a href="{{ route('buku.index') }}" class="nav-item flex items-center space-x-4 text-gray-700 py-3 px-4 rounded-xl transition-all hover:bg-blue-50 {{ request()->routeIs('katalog.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                                <i class="ph-book-open-bold text-2xl"></i>
                                <span class="font-medium">Katalog Buku</span>
                            </a>
                        @endif
                    </div>

                    <!-- Modern Profile & Logout Section -->
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <div class="border-t border-gray-100 pt-4">
                            <div class="flex items-center space-x-4 mb-4 p-3 rounded-xl bg-gray-50 hover:bg-gray-100 transition-all duration-300">
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-blue-100 to-blue-200 flex items-center justify-center">
                                    <i class="ph-user-circle-bold text-2xl text-blue-500"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">{{ auth()->user()->name }}</p>
                                    <p class="text-sm text-gray-500">{{ ucfirst(auth()->user()->role) }}</p>
                                </div>
                            </div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center justify-center space-x-3 text-gray-700 py-3 px-4 rounded-xl transition-all duration-300 hover:bg-red-50 hover:text-red-600 w-full hover:shadow-sm">
                                    <i class="ph-sign-out-bold text-xl"></i>
                                    <span class="font-medium">Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:ml-72 p-8">
            <div class="container mx-auto animate__animated animate__fadeIn">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        
        mobileMenuButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            mobileMenuButton.classList.toggle('rotate-180');
        });

        document.addEventListener('click', (e) => {
            if (window.innerWidth < 1024) {
                if (!sidebar.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                    sidebar.classList.add('-translate-x-full');
                    mobileMenuButton.classList.remove('rotate-180');
                }
            }
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                mobileMenuButton.classList.remove('rotate-180');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });

        $(document).ready(function() {
            $('.select2').select2({
                theme: 'classic',
                dropdownAutoWidth: true,
            });
        });
    </script>
</body>
</html>