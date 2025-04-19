@extends('layouts.app2')

@section('page-title', 'Tentang Kami')
@section('page-subtitle', 'Mengenal lebih dekat Perpustakaanku dan visi misi kami')

@section('breadcrumbs')
    <a href="{{ route('welcome') }}" class="hover:text-white transition-colors duration-300">Beranda</a>
    <i class="fas fa-chevron-right text-xs mx-2"></i>
    <span>Tentang Kami</span>
@endsection

@section('content')
<!-- Hero Section -->
<div class="bg-white rounded-2xl shadow-md overflow-hidden mb-12">
    <div class="relative h-64 md:h-80 lg:h-96 overflow-hidden">
        <img src="data:image/jpeg;base64,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" alt="Perpustakaanku" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-900/80 to-primary-800/50 flex items-center">
            <div class="container mx-auto px-6 md:px-12">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4" data-aos="fade-right">Selamat Datang di Perpustakaanku</h1>
                <p class="text-lg text-primary-100 max-w-2xl" data-aos="fade-right" data-aos-delay="100">Tempat di mana pengetahuan dan inspirasi bertemu untuk menciptakan masa depan yang lebih cerah.</p>
            </div>
        </div>
    </div>
</div>

<!-- Vision & Mission -->
<div class="grid md:grid-cols-2 gap-8 mb-16">
    <div class="bg-white rounded-xl shadow-md p-8" data-aos="fade-up">
        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mb-6">
            <i class="fas fa-eye text-2xl text-primary-600"></i>
        </div>
        <h2 class="text-2xl font-bold text-primary-900 mb-4">Visi Kami</h2>
        <p class="text-primary-700 mb-6">Menjadi pusat pengetahuan terkemuka yang menginspirasi pembelajaran seumur hidup, mendorong inovasi, dan memperkaya kehidupan masyarakat melalui akses ke informasi yang berkualitas.</p>
        <ul class="space-y-3">
            <li class="flex items-start">
                <i class="fas fa-check-circle text-primary-600 mt-1 mr-3"></i>
                <span class="text-primary-700">Menjadi perpustakaan digital terdepan di Indonesia</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-check-circle text-primary-600 mt-1 mr-3"></i>
                <span class="text-primary-700">Menyediakan akses pengetahuan untuk semua kalangan</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-check-circle text-primary-600 mt-1 mr-3"></i>
                <span class="text-primary-700">Mendorong budaya literasi di masyarakat</span>
            </li>
        </ul>
    </div>
    
    <div class="bg-white rounded-xl shadow-md p-8" data-aos="fade-up" data-aos-delay="100">
        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mb-6">
            <i class="fas fa-bullseye text-2xl text-primary-600"></i>
        </div>
        <h2 class="text-2xl font-bold text-primary-900 mb-4">Misi Kami</h2>
        <p class="text-primary-700 mb-6">Kami berkomitmen untuk menyediakan layanan perpustakaan berkualitas tinggi yang memenuhi kebutuhan informasi, pendidikan, dan rekreasi masyarakat.</p>
        <ul class="space-y-3">
            <li class="flex items-start">
                <i class="fas fa-check-circle text-primary-600 mt-1 mr-3"></i>
                <span class="text-primary-700">Mengembangkan koleksi yang beragam dan relevan</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-check-circle text-primary-600 mt-1 mr-3"></i>
                <span class="text-primary-700">Memberikan layanan yang inovatif dan responsif</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-check-circle text-primary-600 mt-1 mr-3"></i>
                <span class="text-primary-700">Menciptakan lingkungan yang mendukung pembelajaran</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-check-circle text-primary-600 mt-1 mr-3"></i>
                <span class="text-primary-700">Membangun kemitraan dengan institusi pendidikan</span>
            </li>
        </ul>
    </div>
</div>

<!-- Our Story -->
<div class="bg-white rounded-xl shadow-md p-8 mb-16" data-aos="fade-up">
    <h2 class="text-2xl font-bold text-primary-900 mb-6 flex items-center">
        <i class="fas fa-book-open text-primary-600 mr-3"></i>
        Cerita Kami
    </h2>
    
    <div class="grid md:grid-cols-5 gap-8">
        <div class="md:col-span-3">
            <p class="text-primary-700 mb-4">Perpustakaanku didirikan pada tahun 2010 dengan visi sederhana: membuat pengetahuan dapat diakses oleh semua orang. Dimulai dengan koleksi 500 buku, kami telah berkembang menjadi salah satu perpustakaan digital terbesar di Indonesia dengan lebih dari 10.000 judul.</p>
            
            <p class="text-primary-700 mb-4">Perjalanan kami dimulai ketika sekelompok pecinta buku dan pendidik memutuskan untuk menciptakan ruang di mana semua orang dapat belajar, tumbuh, dan terinspirasi. Dari awal yang sederhana, kami telah berkembang menjadi pusat pengetahuan yang dinamis yang melayani ribuan pembaca setiap bulannya.</p>
            
            <p class="text-primary-700">Kami percaya bahwa akses ke informasi adalah hak dasar setiap individu. Itulah mengapa kami terus berusaha untuk memperluas koleksi kami, meningkatkan layanan kami, dan menjangkau lebih banyak komunitas. Kami berkomitmen untuk menjadi katalisator perubahan positif melalui kekuatan pengetahuan dan literasi.</p>
        </div>
        
        <div class="md:col-span-2">
            <img src="/api/placeholder/600/400" alt="Sejarah Perpustakaanku" class="w-full h-auto rounded-lg shadow-md">
            
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="bg-primary-50 p-4 rounded-lg text-center">
                    <div class="text-3xl font-bold text-primary-600 mb-1">10K+</div>
                    <div class="text-sm text-primary-700">Judul Buku</div>
                </div>
                <div class="bg-primary-50 p-4 rounded-lg text-center">
                    <div class="text-3xl font-bold text-primary-600 mb-1">15+</div>
                    <div class="text-sm text-primary-700">Tahun Pengalaman</div>
                </div>
                <div class="bg-primary-50 p-4 rounded-lg text-center">
                    <div class="text-3xl font-bold text-primary-600 mb-1">5K+</div>
                    <div class="text-sm text-primary-700">Anggota Aktif</div>
                </div>
                <div class="bg-primary-50 p-4 rounded-lg text-center">
                    <div class="text-3xl font-bold text-primary-600 mb-1">20+</div>
                    <div class="text-sm text-primary-700">Staf Profesional</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Our Team -->
<div class="mb-16" data-aos="fade-up">
    <h2 class="text-2xl font-bold text-primary-900 mb-6 flex items-center">
        <i class="fas fa-users text-primary-600 mr-3"></i>
        Tim Kami
    </h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Team Member 1 -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden group">
            <div class="h-64 overflow-hidden">
                <img src="/api/placeholder/400/400" alt="Nama Anggota Tim" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary-900 mb-1">Ahmad Rizki</h3>
                <p class="text-primary-600 mb-3">Kepala Perpustakaan</p>
                <p class="text-primary-700 text-sm mb-4">Berpengalaman lebih dari 10 tahun dalam manajemen perpustakaan dan pengembangan koleksi.</p>
                <div class="flex space-x-3">
                    <a href="#" class="text-primary-500 hover:text-primary-700 transition-colors duration-300">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="#" class="text-primary-500 hover:text-primary-700 transition-colors duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-primary-500 hover:text-primary-700 transition-colors duration-300">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Team Member 2 -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden group">
            <div class="h-64 overflow-hidden">
                <img src="/api/placeholder/400/400" alt="Nama Anggota Tim" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary-900 mb-1">Siti Nurhayati</h3>
                <p class="text-primary-600 mb-3">Manajer Layanan</p>
                <p class="text-primary-700 text-sm mb-4">Ahli dalam pengembangan program perpustakaan dan layanan pelanggan.</p>
                <div class="flex space-x-3">
                    <a href="#" class="text-primary-500 hover:text-primary-700 transition-colors duration-300">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="#" class="text-primary-500 hover:text-primary-700 transition-colors duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-primary-500 hover:text-primary-700 transition-colors duration-300">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Team Member 3 -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden group">
            <div class="h-64 overflow-hidden">
                <img src="/api/placeholder/400/400" alt="Nama Anggota Tim" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary-900 mb-1">Budi Santoso</h3>
                <p class="text-primary-600 mb-3">Spesialis Digital</p>
                <p class="text-primary-700 text-sm mb-4">Pakar dalam teknologi perpustakaan digital dan sistem manajemen konten.</p>
                <div class="flex space-x-3">
                    <a href="#" class="text-primary-500 hover:text-primary-700 transition-colors duration-300">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="#" class="text-primary-500 hover:text-primary-700 transition-colors duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-primary-500 hover:text-primary-700 transition-colors duration-300">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Team Member 4 -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden group">
            <div class="h-64 overflow-hidden">
                <img src="/api/placeholder/400/400" alt="Nama Anggota Tim" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary-900 mb-1">Dewi Anggraini</h3>
                <p class="text-primary-600 mb-3">Pustakawan Senior</p>
                <p class="text-primary-700 text-sm mb-4">Spesialis dalam pengembangan koleksi dan program literasi masyarakat.</p>
                <div class="flex space-x-3">
                    <a href="#" class="text-primary-500 hover:text-primary-700 transition-colors duration-300">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="#" class="text-primary-500 hover:text-primary-700 transition-colors duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-primary-500 hover:text-primary-700 transition-colors duration-300">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials -->
<div class="mb-16" data-aos="fade-up">
    <h2 class="text-2xl font-bold text-primary-900 mb-6 flex items-center">
        <i class="fas fa-quote-left text-primary-600 mr-3"></i>
        Testimoni Anggota
    </h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Testimonial 1 -->
        <div class="bg-white rounded-xl shadow-md p-6 relative">
            <div class="absolute top-6 right-6 text-4xl text-primary-200 opacity-50">
                <i class="fas fa-quote-right"></i>
            </div>
            <div class="mb-4">
                <i class="fas fa-star text-amber-500"></i>
                <i class="fas fa-star text-amber-500"></i>
                <i class="fas fa-star text-amber-500"></i>
                <i class="fas fa-star text-amber-500"></i>
                <i class="fas fa-star text-amber-500"></i>
            </div>
            <p class="text-primary-700 mb-6 relative z-10">"Perpustakaanku telah menjadi sumber inspirasi dan pengetahuan yang luar biasa bagi saya. Koleksi bukunya sangat lengkap dan stafnya sangat membantu."</p>
            <div class="flex items-center">
                <img src="/api/placeholder/100/100" alt="Foto Testimonial" class="w-12 h-12 rounded-full mr-4 object-cover">
                <div>
                    <h4 class="font-semibold text-primary-900">Rina Wijaya</h4>
                    <p class="text-sm text-primary-600">Mahasiswa</p>
                </div>
            </div>
        </div>
        
        <!-- Testimonial 2 -->
        <div class="bg-white rounded-xl shadow-md p-6 relative">
            <div class="absolute top-6 right-6 text-4xl text-primary-200 opacity-50">
                <i class="fas fa-quote-right"></i>
            </div>
            <div class="mb-4">
                <i class="fas fa-star text-amber-500"></i>
                <i class="fas fa-star text-amber-500"></i>
                <i class="fas fa-star text-amber-500"></i>
                <i class="fas fa-star text-amber-500"></i>
                <i class="fas fa-star-half-alt text-amber-500"></i>
            </div>
            <p class="text-primary-700 mb-6 relative z-10">"Sebagai seorang peneliti, saya sangat menghargai akses ke berbagai sumber daya yang disediakan oleh Perpustakaanku. Layanan digital mereka sangat memudahkan pekerjaan saya."</p>
            <div class="flex items-center">
                <img src="/api/placeholder/100/100" alt="Foto Testimonial" class="w-12 h-12 rounded-full mr-4 object-cover">
                <div>
                    <h4 class="font-semibold text-primary-900">Dr. Hadi Purnomo</h4>
                    <p class="text-sm text-primary-600">Peneliti</p>
                </div>
            </div>
        </div>
        
        <!-- Testimonial 3 -->
        <div class="bg-white rounded-xl shadow-md p-6 relative">
            <div class="absolute top-6 right-6 text-4xl text-primary-200 opacity-50">
                <i class="fas fa-quote-right"></i>
            </div>
            <div class="mb-4">
                <i class="fas fa-star text-amber-500"></i>
                <i class="fas fa-star text-amber-500"></i>
                <i class="fas fa-star text-amber-500"></i>
                <i class="fas fa-star text-amber-500"></i>
                <i class="fas fa-star text-amber-500"></i>
            </div>
            <p class="text-primary-700 mb-6 relative z-10">"Program literasi yang diselenggarakan oleh Perpustakaanku telah membantu anak-anak saya mengembangkan kecintaan membaca sejak dini. Terima kasih atas dedikasi tim!"</p>
            <div class="flex items-center">
                <img src="/api/placeholder/100/100" alt="Foto Testimonial" class="w-12 h-12 rounded-full mr-4 object-cover">
                <div>
                    <h4 class="font-semibold text-primary-900">Maya Indrawati</h4>
                    <p class="text-sm text-primary-600">Orang Tua</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Partners -->
<div class="mb-16" data-aos="fade-up">
    <h2 class="text-2xl font-bold text-primary-900 mb-6 flex items-center">
        <i class="fas fa-handshake text-primary-600 mr-3"></i>
        Mitra Kami
    </h2>
    
    <div class="bg-white rounded-xl shadow-md p-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="flex items-center justify-center p-4 grayscale hover:grayscale-0 transition-all duration-300">
                <img src="/api/placeholder/200/80" alt="Logo Partner" class="max-h-16">
            </div>
            <div class="flex items-center justify-center p-4 grayscale hover:grayscale-0 transition-all duration-300">
                <img src="/api/placeholder/200/80" alt="Logo Partner" class="max-h-16">
            </div>
            <div class="flex items-center justify-center p-4 grayscale hover:grayscale-0 transition-all duration-300">
                <img src="/api/placeholder/200/80" alt="Logo Partner" class="max-h-16">
            </div>
            <div class="flex items-center justify-center p-4 grayscale hover:grayscale-0 transition-all duration-300">
                <img src="/api/placeholder/200/80" alt="Logo Partner" class="max-h-16">
            </div>
            <div class="flex items-center justify-center p-4 grayscale hover:grayscale-0 transition-all duration-300">
                <img src="/api/placeholder/200/80" alt="Logo Partner" class="max-h-16">
            </div>
            <div class="flex items-center justify-center p-4 grayscale hover:grayscale-0 transition-all duration-300">
                <img src="/api/placeholder/200/80" alt="Logo Partner" class="max-h-16">
            </div>
            <div class="flex items-center justify-center p-4 grayscale hover:grayscale-0 transition-all duration-300">
                <img src="/api/placeholder/200/80" alt="Logo Partner" class="max-h-16">
            </div>
            <div class="flex items-center justify-center p-4 grayscale hover:grayscale-0 transition-all duration-300">
                <img src="/api/placeholder/200/80" alt="Logo Partner" class="max-h-16">
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-primary-900 rounded-2xl shadow-xl p-8 md:p-12 text-center" data-aos="fade-up">
    <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Bergabunglah dengan Komunitas Kami</h2>
    <p class="text-primary-200 mb-8 max-w-2xl mx-auto">Jadilah bagian dari komunitas pembaca kami dan akses ribuan buku dari berbagai kategori. Keanggotaan gratis untuk 30 hari pertama!</p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="/register" class="bg-white text-primary-800 px-6 py-3 rounded-lg hover:bg-primary-50 transition-colors duration-300 font-medium flex items-center justify-center">
            <i class="fas fa-user-plus mr-2"></i>
            Daftar Sekarang
        </a>
        <a href="{{ route('contact') }}" class="bg-primary-700 text-white px-6 py-3 rounded-lg hover:bg-primary-600 transition-colors duration-300 font-medium flex items-center justify-center">
            <i class="fas fa-info-circle mr-2"></i>
            Pelajari Lebih Lanjut
        </a>
    </div>
</div>
@endsection