@extends('layouts.app2')

@section('page-title', 'Kontak Kami')
@section('page-subtitle', 'Hubungi kami untuk informasi lebih lanjut atau bantuan')

@section('breadcrumbs')
    <a href="{{ route('welcome') }}" class="hover:text-white transition-colors duration-300">Beranda</a>
    <i class="fas fa-chevron-right text-xs mx-2"></i>
    <span>Kontak</span>
@endsection

@section('content')
<!-- Contact Section -->
<div class="grid md:grid-cols-3 gap-8 mb-16">
    <!-- Contact Info -->
    <div class="md:col-span-1">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-primary-700 p-6 text-white">
                <h2 class="text-xl font-bold mb-2">Informasi Kontak</h2>
                <p class="text-primary-100">Hubungi kami melalui salah satu metode berikut:</p>
            </div>
            
            <div class="p-6">
                <div class="space-y-6">
                    <!-- Address -->
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mr-4 shrink-0">
                            <i class="fas fa-map-marker-alt text-xl text-primary-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-primary-900 mb-1">Alamat</h3>
                            <p class="text-primary-700">Jalan Buku No. 123, Kota Literasi, 12345, Indonesia</p>
                        </div>
                    </div>
                    
                    <!-- Phone -->
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mr-4 shrink-0">
                            <i class="fas fa-phone-alt text-xl text-primary-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-primary-900 mb-1">Telepon</h3>
                            <p class="text-primary-700">+62 123 456 789</p>
                            <p class="text-primary-700">+62 987 654 321</p>
                        </div>
                    </div>
                    
                    <!-- Email -->
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mr-4 shrink-0">
                            <i class="fas fa-envelope text-xl text-primary-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-primary-900 mb-1">Email</h3>
                            <p class="text-primary-700">info@perpustakaanku.com</p>
                            <p class="text-primary-700">support@perpustakaanku.com</p>
                        </div>
                    </div>
                    
                    <!-- Hours -->
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mr-4 shrink-0">
                            <i class="fas fa-clock text-xl text-primary-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-primary-900 mb-1">Jam Operasional</h3>
                            <p class="text-primary-700">Senin - Jumat: 08:00 - 20:00</p>
                            <p class="text-primary-700">Sabtu: 09:00 - 17:00</p>
                            <p class="text-primary-700">Minggu: Tutup</p>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="mt-8">
                    <h3 class="font-semibold text-primary-900 mb-3">Ikuti Kami</h3>
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center hover:bg-primary-200 transition-colors duration-300">
                            <i class="fab fa-facebook-f text-primary-600"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center hover:bg-primary-200 transition-colors duration-300">
                            <i class="fab fa-twitter text-primary-600"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center hover:bg-primary-200 transition-colors duration-300">
                            <i class="fab fa-instagram text-primary-600"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center hover:bg-primary-200 transition-colors duration-300">
                            <i class="fab fa-youtube text-primary-600"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center hover:bg-primary-200 transition-colors duration-300">
                            <i class="fab fa-linkedin-in text-primary-600"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Contact Form -->
    <div class="md:col-span-2">
        <div class="bg-white rounded-xl shadow-md p-8">
            <h2 class="text-2xl font-bold text-primary-900 mb-6">Kirim Pesan</h2>
            
            <form action="#" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-primary-700 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-primary-400"></i>
                            </div>
                            <input type="text" id="name" name="name" class="pl-10 pr-4 py-3 w-full rounded-lg border border-primary-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" placeholder="Masukkan nama lengkap">
                        </div>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-primary-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-primary-400"></i>
                            </div>
                            <input type="email" id="email" name="email" class="pl-10 pr-4 py-3 w-full rounded-lg border border-primary-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" placeholder="Masukkan alamat email">
                        </div>
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-primary-700 mb-2">Nomor Telepon</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone-alt text-primary-400"></i>
                            </div>
                            <input type="tel" id="phone" name="phone" class="pl-10 pr-4 py-3 w-full rounded-lg border border-primary-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" placeholder="Masukkan nomor telepon">
                        </div>
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-sm font-medium text-primary-700 mb-2">Subjek</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-tag text-primary-400"></i>
                            </div>
                            <select id="subject" name="subject" class="pl-10 pr-4 py-3 w-full rounded-lg border border-primary-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent appearance-none bg-white">
                                <option value="">Pilih subjek</option>
                                <option value="general">Pertanyaan Umum</option>
                                <option value="membership">Keanggotaan</option>
                                <option value="books">Koleksi Buku</option>
                                <option value="services">Layanan</option>
                                <option value="feedback">Umpan Balik</option>
                                <option value="other">Lainnya</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label for="message" class="block text-sm font-medium text-primary-700 mb-2">Pesan</label>
                    <div class="relative">
                        <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                            <i class="fas fa-comment-alt text-primary-400"></i>
                        </div>
                        <textarea id="message" name="message" rows="6" class="pl-10 pr-4 py-3 w-full rounded-lg border border-primary-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" placeholder="Tulis pesan Anda di sini..."></textarea>
                    </div>
                </div>
                
                <div class="flex items-center mb-6">
                    <input type="checkbox" id="privacy" name="privacy" class="w-4 h-4 text-primary-600 border-primary-300 rounded focus:ring-primary-500">
                    <label for="privacy" class="ml-2 text-sm text-primary-700">
                        Saya menyetujui <a href="#" class="text-primary-600 hover:underline">kebijakan privasi</a> dan penggunaan data saya untuk keperluan komunikasi.
                    </label>
                </div>
                
                <button type="submit" class="bg-primary-600 text-white px-6 py-3 rounded-lg hover:bg-primary-700 transition-colors duration-300 font-medium flex items-center justify-center">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="mb-16" data-aos="fade-up">
    <h2 class="text-2xl font-bold text-primary-900 mb-6 flex items-center">
        <i class="fas fa-question-circle text-primary-600 mr-3"></i>
        Pertanyaan yang Sering Diajukan
    </h2>
    
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="space-y-4" x-data="{active: 0}">
            <!-- FAQ Item 1 -->
            <div class="border border-primary-100 rounded-lg overflow-hidden">
                <button @click="active = active === 1 ? 0 : 1" class="flex justify-between items-center w-full p-4 text-left font-medium text-primary-900 hover:bg-primary-50 transition-colors duration-300">
                    <span>Bagaimana cara menjadi anggota perpustakaan?</span>
                    <i class="fas" :class="active === 1 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </button>
                <div x-show="active === 1" class="p-4 bg-primary-50 border-t border-primary-100">
                    <p class="text-primary-700">
                        Untuk menjadi anggota perpustakaan, Anda dapat mendaftar secara online melalui website kami atau datang langsung ke perpustakaan dengan membawa kartu identitas yang masih berlaku. Setelah mengisi formulir pendaftaran dan membayar biaya keanggotaan (jika ada), Anda akan mendapatkan kartu anggota yang dapat digunakan untuk meminjam buku dan mengakses layanan perpustakaan lainnya.
                    </p>
                </div>
            </div>
            
            <!-- FAQ Item 2 -->
            <div class="border border-primary-100 rounded-lg overflow-hidden">
                <button @click="active = active === 2 ? 0 : 2" class="flex justify-between items-center w-full p-4 text-left font-medium text-primary-900 hover:bg-primary-50 transition-colors duration-300">
                    <span>Berapa lama waktu peminjaman buku?</span>
                    <i class="fas" :class="active === 2 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </button>
                <div x-show="active === 2" class="p-4 bg-primary-50 border-t border-primary-100">
                    <p class="text-primary-700">
                        Waktu peminjaman buku standar adalah 14 hari. Anda dapat memperpanjang masa peminjaman sebanyak dua kali, masing-masing untuk 7 hari, selama tidak ada anggota lain yang memesan buku tersebut. Perpanjangan dapat dilakukan secara online melalui akun Anda atau dengan menghubungi petugas perpustakaan.
                    </p>
                </div>
            </div>
            
            <!-- FAQ Item 3 -->
            <div class="border border-primary-100 rounded-lg overflow-hidden">
                <button @click="active = active === 3 ? 0 : 3" class="flex justify-between items-center w-full p-4 text-left font-medium text-primary-900 hover:bg-primary-50 transition-colors duration-300">
                    <span>Apakah ada denda untuk keterlambatan pengembalian buku?</span>
                    <i class="fas" :class="active === 3 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </button>
                <div x-show="active === 3" class="p-4 bg-primary-50 border-t border-primary-100">
                    <p class="text-primary-700">
                        Ya, ada denda untuk keterlambatan pengembalian buku. Denda dihitung per hari keterlambatan dan bervariasi tergantung jenis buku. Untuk buku umum, denda adalah Rp 1.000 per hari, sedangkan untuk buku referensi atau koleksi khusus, denda bisa mencapai Rp 5.000 per hari. Kami mendorong anggota untuk mengembalikan buku tepat waktu atau memperpanjang masa peminjaman jika diperlukan.
                    </p>
                </div>
            </div>
            
            <!-- FAQ Item 4 -->
            <div class="border border-primary-100 rounded-lg overflow-hidden">
                <button @click="active = active === 4 ? 0 : 4" class="flex justify-between items-center w-full p-4 text-left font-medium text-primary-900 hover:bg-primary-50 transition-colors duration-300">
                    <span>Bagaimana cara mengakses e-book dan sumber daya digital?</span>
                    <i class="fas" :class="active === 4 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </button>
                <div x-show="active === 4" class="p-4 bg-primary-50 border-t border-primary-100">
                    <p class="text-primary-700">
                        Anggota perpustakaan dapat mengakses e-book dan sumber daya digital melalui portal online kami. Setelah login dengan akun anggota Anda, Anda dapat menjelajahi katalog digital dan mengunduh atau membaca e-book secara online. Kami juga menyediakan akses ke berbagai database penelitian dan jurnal elektronik. Untuk bantuan lebih lanjut, silakan hubungi tim layanan digital kami.
                    </p>
                </div>
            </div>
            
            <!-- FAQ Item 5 -->
            <div class="border border-primary-100 rounded-lg overflow-hidden">
                <button @click="active = active === 5 ? 0 : 5" class="flex justify-between items-center w-full p-4 text-left font-medium text-primary-900 hover:bg-primary-50 transition-colors duration-300">
                    <span>Apakah perpustakaan menyediakan layanan fotokopi?</span>
                    <i class="fas" :class="active === 5 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </button>
                <div x-show="active === 5" class="p-4 bg-primary-50 border-t border-primary-100">
                    <p class="text-primary-700">
                        Ya, perpustakaan kami menyediakan layanan fotokopi dengan biaya tertentu. Namun, perlu diingat bahwa fotokopi hanya diperbolehkan untuk bagian-bagian tertentu dari buku sesuai dengan ketentuan hak cipta. Biaya fotokopi adalah Rp 500 per lembar untuk ukuran A4 hitam-putih dan Rp 2.000 per lembar untuk ukuran A4 berwarna.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Map Section -->
<div class="mb-16" data-aos="fade-up">
    <h2 class="text-2xl font-bold text-primary-900 mb-6 flex items-center">
        <i class="fas fa-map-marked-alt text-primary-600 mr-3"></i>
        Lokasi Kami
    </h2>
    
    <div class="bg-white rounded-xl shadow-md p-4 overflow-hidden">
        <div class="h-96 rounded-lg overflow-hidden">
            <!-- Replace with your actual map embed code -->
            <div class="w-full h-full bg-primary-100 flex items-center justify-center">
                <div class="text-center">
                    <i class="fas fa-map-marker-alt text-4xl text-primary-600 mb-4"></i>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.6397840464697!2d106.75225837402647!3d-6.31096306175798!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ef006fe81853%3A0x5e708e36d8dabb6e!2sPoliteknik%20LP3I%20Jakarta%20Kampus%20Ciputat%20Tangerang%20Selatan!5e0!3m2!1sid!2sid!4v1742311418125!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                </div>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter Section -->
<div class="bg-primary-900 rounded-2xl shadow-xl p-8 md:p-12" data-aos="fade-up">
    <div class="grid md:grid-cols-5 gap-8 items-center">
        <div class="md:col-span-3">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Berlangganan Newsletter</h2>
            <p class="text-primary-200 mb-4">Dapatkan informasi terbaru tentang koleksi buku, acara, dan program perpustakaan langsung ke inbox Anda.</p>
            <ul class="space-y-2 text-primary-200">
                <li class="flex items-center">
                    <i class="fas fa-check-circle text-primary-400 mr-2"></i>
                    <span>Pemberitahuan tentang buku baru</span>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-check-circle text-primary-400 mr-2"></i>
                    <span>Undangan ke acara dan workshop</span>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-check-circle text-primary-400 mr-2"></i>
                    <span>Tips dan rekomendasi bacaan</span>
                </li>
            </ul>
        </div>
        <div class="md:col-span-2">
            <form action="#" method="POST" class="space-y-4">
                @csrf
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-primary-400"></i>
                    </div>
                    <input type="email" name="email" class="pl-10 pr-4 py-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" placeholder="Alamat email Anda">
                </div>
                <button type="submit" class="w-full bg-primary-600 text-white px-6 py-3 rounded-lg hover:bg-primary-500 transition-colors duration-300 font-medium flex items-center justify-center">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Berlangganan
                </button>
                <p class="text-xs text-primary-400 text-center">Kami menghormati privasi Anda. Anda dapat berhenti berlangganan kapan saja.</p>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endsection