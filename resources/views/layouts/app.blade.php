{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaanku</title>
    
    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Mobile Menu Button -->
        <div class="lg:hidden fixed top-4 left-4 z-50">
            <button id="mobile-menu-button" class="p-2 rounded-md bg-blue-800 text-white focus:outline-none">
                <i class="ri-menu-line text-xl"></i>
            </button>
        </div>

        <!-- Sidebar -->
        <div id="sidebar" class="fixed left-0 top-0 w-64 h-full transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40">
            <div class="h-full bg-gradient-to-b from-blue-800 to-blue-900 shadow-xl">
                <!-- Logo/Brand -->
                <div class="flex items-center justify-center h-16 bg-blue-900 bg-opacity-50">
                    <span class="text-white text-xl font-bold">Perpustakaanku</span>
                </div>

                <!-- Navigation -->
                <nav class="mt-8 px-4">
                    <div class="space-y-2">
                        @if(auth()->user()->role === 'admin')
                            {{-- Admin Navigation --}}
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 text-white py-3 px-4 rounded-lg transition-colors hover:bg-blue-700 {{ request()->routeIs('dashboard') ? 'bg-blue-700' : '' }}">
                                <i class="ri-dashboard-line text-xl"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{ route('adminmahasiswa.index') }}" class="flex items-center space-x-3 text-white py-3 px-4 rounded-lg transition-colors hover:bg-blue-700 {{ request()->routeIs('users.*') ? 'bg-blue-700' : '' }}">
                                <i class="ri-user-line text-xl"></i>
                                <span>Data Mahasiswa</span>
                            </a>
                            <a href="{{ route('users.index') }}" class="flex items-center space-x-3 text-white py-3 px-4 rounded-lg transition-colors hover:bg-blue-700 {{ request()->routeIs('users.*') ? 'bg-blue-700' : '' }}">
                                <i class="ri-user-line text-xl"></i>
                                <span>Data admin/petugas</span>
                            </a>

                        @else
                            {{-- Staff Navigation --}}
                            <a href="{{ route('petugas.dashboard') }}" class="flex items-center space-x-3 text-white py-3 px-4 rounded-lg transition-colors hover:bg-blue-700 {{ request()->routeIs('dashboard') ? 'bg-blue-700' : '' }}">
                                <i class="ri-dashboard-line text-xl"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{ route('buku.index') }}" class="flex items-center space-x-3 text-white py-3 px-4 rounded-lg transition-colors hover:bg-blue-700 {{ request()->routeIs('dashboard') ? 'bg-blue-700' : '' }}">
                                <i class="ri-dashboard-line text-xl"></i>
                                <span>Buku</span>
                            </a>
                        @endif
                    </div>

                    <!-- Profile & Logout Section -->
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <div class="border-t border-blue-700 pt-4">
                            <div class="flex items-center space-x-3 text-white mb-4">
                                <div class="w-10 h-10 rounded-full bg-blue-700 flex items-center justify-center">
                                    <i class="ri-user-line text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-medium">{{ auth()->user()->name }}</p>
                                    <p class="text-sm text-blue-200">{{ ucfirst(auth()->user()->role) }}</p>
                                </div>
                            </div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center space-x-3 text-white py-3 px-4 rounded-lg transition-colors hover:bg-blue-700 w-full">
                                    <i class="ri-logout-box-line text-xl"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:ml-64 p-8">
            <div class="container mx-auto">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        // Sidebar Toggle Functionality
        const sidebar = document.getElementById('sidebar');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        
        mobileMenuButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 1024) {  // lg breakpoint
                if (!sidebar.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                    sidebar.classList.add('-translate-x-full');
                }
            }
        });

        // Handle resize events
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {  // lg breakpoint
                sidebar.classList.remove('-translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
    <script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
</body>
</html>