<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4 py-16">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="relative" data-aos="fade-right">
                <img src="https://cdni.iconscout.com/illustration/premium/thumb/library-book-shelf-5472825-4569550.png" 
                     alt="Library 3D Illustration" 
                     class="w-full h-auto transform hover:scale-105 transition-transform duration-300">
            </div>

            <div class="text-center md:text-left" data-aos="fade-left">
                <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 mb-6 leading-tight">
                    Selamat Datang di Perpustakaanku
                </h1>
                <p class="text-xl text-blue-800 mb-8 leading-relaxed">
                    Info seputar buku dan peminjaman dalam perpustakaanku.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-col md:flex-row gap-4 justify-center md:justify-start">
                    <a href="/login" class="bg-blue-600 text-white px-8 py-3 rounded-full 
                        hover:bg-blue-700 transition duration-300 ease-in-out 
                        transform hover:-translate-y-1 shadow-lg">
                        Login
                    </a>
                    <a href="/register" class="bg-white text-blue-600 px-8 py-3 rounded-full 
                        border-2 border-blue-600 hover:bg-blue-50 transition duration-300 
                        ease-in-out transform hover:-translate-y-1 shadow-md">
                        Register
                    </a>
                </div>

                <!-- Features Highlights -->
                <div class="mt-12 grid grid-cols-3 gap-4">
                    <div class="text-center bg-white/50 p-4 rounded-xl shadow-sm">
                        <svg class="w-10 h-10 mx-auto text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <p class="text-sm text-blue-800">10K+ Books</p>
                    </div>
                    <div class="text-center bg-white/50 p-4 rounded-xl shadow-sm">
                        <svg class="w-10 h-10 mx-auto text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        <p class="text-sm text-blue-800">Verified</p>
                    </div>
                    <div class="text-center bg-white/50 p-4 rounded-xl shadow-sm">
                        <svg class="w-10 h-10 mx-auto text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-sm text-blue-800">24/7 Support</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- AOS and Optional JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
</body>
</html>