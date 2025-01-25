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


    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Profile Overview -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <div class="md:flex items-center">
                <div class="md:w-1/4">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&size=200" class="w-32 h-32 rounded-full mx-auto">
                </div>
                <div class="md:w-3/4 mt-4 md:mt-0">
                    <h1 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h1>
                    <p class="text-gray-600">{{ Auth::user()->mahasiswa->nim }}</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <p class="text-blue-600 font-semibold">Jurusan</p>
                            <p class="text-gray-800">{{ Auth::user()->mahasiswa->jurusan }}</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <p class="text-green-600 font-semibold">Fakultas</p>
                            <p class="text-gray-800">{{ Auth::user()->mahasiswa->fakultas }}</p>
                        </div>
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <p class="text-purple-600 font-semibold">Angkatan</p>
                            <p class="text-gray-800">{{ Auth::user()->mahasiswa->angkatan }}</p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        
        </div>
    </div>
</body>
</html>