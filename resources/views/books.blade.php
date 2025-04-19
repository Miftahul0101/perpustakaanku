@extends('layouts.app2')

@section('page-title', isset($kategori) ? 'Buku Kategori: ' . $kategori->nama : 'Semua Buku')
@section('page-subtitle', isset($kategori) ? ($kategori->deskripsi ?? 'Jelajahi koleksi buku kami dalam kategori ini') : 'Temukan berbagai buku menarik di perpustakaan kami')

@section('breadcrumbs')
    <a href="{{ route('welcome') }}" class="hover:text-white transition-colors duration-300">Beranda</a>
    <i class="fas fa-chevron-right text-xs mx-2"></i>
    <a href="{{ route('books.all') }}" class="hover:text-white transition-colors duration-300">Buku</a>
    @if(isset($kategori))
        <i class="fas fa-chevron-right text-xs mx-2"></i>
        <span>{{ $kategori->nama }}</span>
    @endif
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-8">
    <!-- Sidebar with categories -->
    <div class="md:col-span-1 order-2 md:order-1">
        <div class="bg-white p-6 rounded-xl shadow-md sticky top-24">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-primary-900">Kategori</h3>
                <span class="text-xs font-medium bg-primary-100 text-primary-800 px-2 py-1 rounded-full">{{ $kategoris->count() }}</span>
            </div>
            
            <!-- Search Categories -->
            <div class="relative mb-4">
                <input type="text" id="search-sidebar-categories" placeholder="Cari kategori..." class="w-full pl-9 pr-4 py-2 text-sm rounded-lg border border-primary-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-primary-400 text-sm"></i>
            </div>
            
            <div class="max-h-[calc(100vh-250px)] overflow-y-auto pr-2 -mr-2">
                <ul class="space-y-1" id="categories-list">
                    <li class="category-item" data-category-name="semua buku">
                        <a href="{{ route('books.all') }}" class="flex items-center justify-between p-2 rounded-lg {{ !isset($kategori) ? 'bg-primary-100 text-primary-800 font-medium' : 'hover:bg-primary-50' }} transition-colors duration-300">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-books text-primary-600"></i>
                                <span>Semua Buku</span>
                            </div>
                            <span class="text-xs bg-white px-2 py-0.5 rounded-full {{ !isset($kategori) ? 'text-primary-800' : 'text-primary-600' }}">{{ $total_books ?? 0 }}</span>
                        </a>
                    </li>
                    @foreach($kategoris as $kat)
                    <li class="category-item" data-category-name="{{ strtolower($kat->nama) }}">
                        <a href="{{ route('category.books', $kat->id) }}" class="flex items-center justify-between p-2 rounded-lg {{ isset($kategori) && $kategori->id == $kat->id ? 'bg-primary-100 text-primary-800 font-medium' : 'hover:bg-primary-50' }} transition-colors duration-300">
                            <div class="flex items-center space-x-2">
                                @switch($loop->index % 6)
                                    @case(0)
                                        <i class="fas fa-book text-primary-600"></i>
                                        @break
                                    @case(1)
                                        <i class="fas fa-flask text-primary-600"></i>
                                        @break
                                    @case(2)
                                        <i class="fas fa-landmark text-primary-600"></i>
                                        @break
                                    @case(3)
                                        <i class="fas fa-code text-primary-600"></i>
                                        @break
                                    @case(4)
                                        <i class="fas fa-paint-brush text-primary-600"></i>
                                        @break
                                    @default
                                        <i class="fas fa-globe text-primary-600"></i>
                                @endswitch
                                <span>{{ $kat->nama }}</span>
                            </div>
                            <span class="text-xs bg-white px-2 py-0.5 rounded-full {{ isset($kategori) && $kategori->id == $kat->id ? 'text-primary-800' : 'text-primary-600' }}">{{ $kat->bukus_count }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
                
                <!-- Empty State for Sidebar Search (Hidden by default) -->
                <div id="sidebar-empty-state" class="hidden text-center py-8">
                    <i class="fas fa-search text-primary-300 text-2xl mb-2"></i>
                    <p class="text-primary-600 text-sm">Tidak ada kategori yang sesuai</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Book listings -->
    <div class="md:col-span-3 order-1 md:order-2">
        <!-- Filters and Search -->
        <div class="bg-white p-4 rounded-xl shadow-md mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="relative w-full sm:w-64">
                <input type="text" id="search-books" placeholder="Cari judul atau penulis..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-primary-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-primary-400"></i>
            </div>
            
            <div class="flex items-center space-x-2 w-full sm:w-auto">
                <select id="sort-books" class="pl-4 pr-10 py-2 rounded-lg border border-primary-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent appearance-none bg-white w-full sm:w-auto">
                    <option value="newest">Terbaru</option>
                    <option value="title-asc">Judul (A-Z)</option>
                    <option value="title-desc">Judul (Z-A)</option>
                    <option value="author-asc">Penulis (A-Z)</option>
                    <option value="author-desc">Penulis (Z-A)</option>
                </select>
                <button id="grid-view" class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary-100 text-primary-800 hover:bg-primary-200 transition-colors duration-300">
                    <i class="fas fa-th-large"></i>
                </button>
                <button id="list-view" class="w-10 h-10 flex items-center justify-center rounded-lg hover:bg-primary-100 text-primary-600 transition-colors duration-300">
                    <i class="fas fa-list"></i>
                </button>
            </div>
        </div>
        
        @if($bukus->count() > 0)
            <!-- Book Count -->
            <div class="mb-4 flex items-center">
                <span class="text-sm text-primary-600">Menampilkan {{ $bukus->count() }} dari {{ $bukus->total() }} buku</span>
            </div>
            
            <!-- Grid View (Default) -->
            <div id="books-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($bukus as $buku)
                <div class="book-card bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 group" data-title="{{ strtolower($buku->judul) }}" data-author="{{ strtolower($buku->penulis) }}">
                    <div class="h-48 overflow-hidden relative">
                        <div class="absolute top-2 right-2 z-10">
                            <span class="bg-primary-600 text-white text-xs font-bold px-2 py-1 rounded-full">Baru</span>
                        </div>
                        <img src="{{ Storage::url($buku->foto) }}" alt="{{ $buku->judul }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                            <div class="p-4 w-full">
                                <a href="#" class="w-full bg-white text-primary-600 px-4 py-2 rounded-lg hover:bg-primary-50 transition-colors duration-300 flex items-center justify-center font-medium text-sm">
                                    <i class="fas fa-eye mr-2"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach($buku->kategoris as $kategori)
                            <a href="{{ route('category.books', $kategori->id) }}" class="text-xs font-medium bg-primary-100 text-primary-800 px-2 py-1 rounded-full hover:bg-primary-200 transition-colors duration-300">{{ $kategori->nama }}</a>
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
            
            <!-- List View (Hidden by default) -->
            <div id="books-list" class="hidden space-y-4">
                @foreach($bukus as $buku)
                <div class="book-card bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col sm:flex-row" data-title="{{ strtolower($buku->judul) }}" data-author="{{ strtolower($buku->penulis) }}">
                    <div class="sm:w-48 h-48 overflow-hidden relative">
                        <img src="{{ Storage::url($buku->foto) }}" alt="{{ $buku->judul }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach($buku->kategoris as $kategori)
                            <a href="{{ route('category.books', $kategori->id) }}" class="text-xs font-medium bg-primary-100 text-primary-800 px-2 py-1 rounded-full hover:bg-primary-200 transition-colors duration-300">{{ $kategori->nama }}</a>
                            @endforeach
                        </div>
                        <h3 class="text-xl font-bold text-primary-900 mb-2">{{ $buku->judul }}</h3>
                        <p class="text-gray-600 mb-4 text-sm flex-grow">{{ $buku->deskripsi ?? 'Deskripsi buku tidak tersedia.' }}</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <i class="fas fa-user-edit text-primary-500 mr-2"></i>
                                <span class="text-primary-600 font-medium">{{ $buku->penulis }}</span>
                            </div>
                            <a href="#" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors duration-300 flex items-center">
                                <i class="fas fa-eye mr-2"></i> Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-12">
                {{ $bukus->links() }}
            </div>
            
            <!-- Empty State for Book Search (Hidden by default) -->
            <div id="books-empty-state" class="hidden bg-primary-50 p-8 rounded-xl text-center mt-8">
                <i class="fas fa-search text-5xl text-primary-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-primary-800 mb-2">Buku Tidak Ditemukan</h3>
                <p class="text-primary-600 mb-4">Tidak ada buku yang sesuai dengan pencarian Anda.</p>
                <button id="reset-book-search" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors duration-300 inline-flex items-center">
                    <i class="fas fa-redo-alt mr-2"></i>
                    Reset Pencarian
                </button>
            </div>
        @else
            <div class="bg-primary-50 p-8 rounded-xl text-center">
                <i class="fas fa-book-open text-5xl text-primary-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-primary-800 mb-2">Tidak Ada Buku</h3>
                <p class="text-primary-600 mb-4">Belum ada buku yang tersedia dalam kategori ini.</p>
                <a href="{{ route('books.all') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors duration-300 inline-flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Lihat Semua Buku
                </a>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // View toggle
        const gridView = document.getElementById('grid-view');
        const listView = document.getElementById('list-view');
        const booksGrid = document.getElementById('books-grid');
        const booksList = document.getElementById('books-list');
        
        gridView.addEventListener('click', function() {
            booksGrid.classList.remove('hidden');
            booksList.classList.add('hidden');
            gridView.classList.add('bg-primary-100', 'text-primary-800');
            gridView.classList.remove('text-primary-600');
            listView.classList.remove('bg-primary-100', 'text-primary-800');
            listView.classList.add('text-primary-600');
        });
        
        listView.addEventListener('click', function() {
            booksGrid.classList.add('hidden');
            booksList.classList.remove('hidden');
            listView.classList.add('bg-primary-100', 'text-primary-800');
            listView.classList.remove('text-primary-600');
            gridView.classList.remove('bg-primary-100', 'text-primary-800');
            gridView.classList.add('text-primary-600');
        });
        
        // Book search functionality
        const searchInput = document.getElementById('search-books');
        const bookCards = document.querySelectorAll('.book-card');
        const booksEmptyState = document.getElementById('books-empty-state');
        const resetBookSearch = document.getElementById('reset-book-search');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            let visibleCount = 0;
            
            bookCards.forEach(card => {
                const title = card.getAttribute('data-title');
                const author = card.getAttribute('data-author');
                
                if (title.includes(searchTerm) || author.includes(searchTerm)) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });
            
            if (visibleCount === 0) {
                booksGrid.classList.add('hidden');
                booksList.classList.add('hidden');
                booksEmptyState.classList.remove('hidden');
            } else {
                if (!booksGrid.classList.contains('hidden')) {
                    booksGrid.classList.remove('hidden');
                } else {
                    booksList.classList.remove('hidden');
                }
                booksEmptyState.classList.add('hidden');
            }
        });
        
        if (resetBookSearch) {
            resetBookSearch.addEventListener('click', function() {
                searchInput.value = '';
                bookCards.forEach(card => card.classList.remove('hidden'));
                
                if (gridView.classList.contains('bg-primary-100')) {
                    booksGrid.classList.remove('hidden');
                    booksList.classList.add('hidden');
                } else {
                    booksGrid.classList.add('hidden');
                    booksList.classList.remove('hidden');
                }
                
                booksEmptyState.classList.add('hidden');
            });
        }
        
        // Sidebar category search
        const sidebarSearchInput = document.getElementById('search-sidebar-categories');
        const categoryItems = document.querySelectorAll('.category-item');
        const sidebarEmptyState = document.getElementById('sidebar-empty-state');
        
        sidebarSearchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            let visibleCount = 0;
            
            categoryItems.forEach(item => {
                const categoryName = item.getAttribute('data-category-name');
                
                if (categoryName.includes(searchTerm)) {
                    item.classList.remove('hidden');
                    visibleCount++;
                } else {
                    item.classList.add('hidden');
                }
            });
            
            if (visibleCount === 0) {
                sidebarEmptyState.classList.remove('hidden');
            } else {
                sidebarEmptyState.classList.add('hidden');
            }
        });
    });
</script>
@endsection