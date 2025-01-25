<!DOCTYPE html>
<html>
<head>
    <title>Login - Campus Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
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
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-50">

    <nav class="p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold text-blue-600">Perpustakaanku</div>
            <a href="{{ route('register') }}" class="px-6 py-2 bg-white text-blue-600 rounded-lg shadow-md hover:shadow-lg transition duration-300">Register</a>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">

                <div class="w-full lg:w-1/2 max-w-md">
                    <div class="bg-white rounded-2xl shadow-2xl p-8 gradient-border">
                        <div class="mb-8 text-center">
                            <h1 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang Kembali!</h1>
                            <p class="text-gray-600">Silahkan masuk menggunakan akun Anda</p>
                        </div>

                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded">
                                <ul class="list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                        </svg>
                                    </div>
                                    <input type="email" id="email" name="email" required
                                        class="block w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Masukan Email Anda">
                                </div>
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
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
                                <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Forgot password?</a>
                            </div>

                            <button type="submit" 
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                                Masuk
                            </button>
                        </form>

                        <div class="mt-6 text-center text-sm">
                            <span class="text-gray-600">Belum mempunyai akun?</span>
                            <a href="{{ route('register') }}" class="ml-1 text-blue-600 hover:text-blue-800 font-medium">Register here</a>
                        </div>
                    </div>
                </div>


                <div class="w-full lg:w-1/2 hidden lg:block">
                    <div class="floating relative">
                        
                        <div class="absolute top-0 right-0 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                        <div class="absolute top-0 right-8 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                        <div class="absolute -bottom-8 right-20 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
                        
                        
                        <div class="relative z-10 p-8">
                            <div class="w-full max-w-lg mx-auto">
                                <div class="bg-white rounded-2xl shadow-2xl p-8 transform rotate-3">
                                    <div class="w-full h-64 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-32 h-32 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>