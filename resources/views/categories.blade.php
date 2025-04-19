@extends('layouts.app2')

@section('page-title', 'Kategori Buku')
@section('page-subtitle', 'Jelajahi berbagai kategori buku yang tersedia di perpustakaan kami')

@section('breadcrumbs')
    <a href="{{ route('welcome') }}" class="hover:text-white transition-colors duration-300">Beranda</a>
    <i class="fas fa-chevron-right text-xs mx-2"></i>
    <span>Kategori</span>
@endsection

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-800">
            <i class="fas fa-th-large mr-2"></i>
            <span>{{ $kategoris->count() }} Kategori</span>
        </div>
    </div>
    
    <div class="relative">
        <input type="text" id="search-categories" placeholder="Cari kategori..." class="w-full sm:w-64 pl-10 pr-4 py-2 rounded-lg border border-primary-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-primary-400"></i>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="categories-container">
    @foreach($kategoris as $kategori)
    <a href="{{ route('category.books', $kategori->id) }}" class="group category-card" data-category-name="{{ strtolower($kategori->nama) }}">
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 text-center group-hover:bg-primary-50 border border-transparent group-hover:border-primary-200 h-full flex flex-col justify-between">
            <div>
                <div class="w-16 h-16 mx-auto mb-4 bg-primary-100 rounded-full flex items-center justify-center group-hover:bg-primary-200 transition-colors duration-300">
                    @switch($loop->index % 6)
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
                        @case(4)
                            <i class="fas fa-paint-brush text-2xl text-primary-600"></i>
                            @break
                        @default
                            <i class="fas fa-globe text-2xl text-primary-600"></i>
                    @endswitch
                </div>
                <h3 class="text-lg font-semibold text-primary-800 group-hover:text-primary-600 mb-2">{{ $kategori->nama }}</h3>
                <p class="text-primary-600/70 text-sm">{{ $kategori->deskripsi ?? 'Jelajahi koleksi buku kami' }}</p>
            </div>
            <div class="mt-4">
                <div class="bg-primary-50 py-1 px-3 rounded-full inline-block group-hover:bg-white transition-colors duration-300">
                    <span class="text-primary-700 text-sm font-medium">{{ $kategori->bukus_count }} Buku</span>
                </div>
            </div>
        </div>
    </a>
    @endforeach
</div>

<!-- Empty State (Hidden by default) -->
<div id="empty-state" class="hidden bg-primary-50 p-8 rounded-xl text-center mt-8">
    <i class="fas fa-search text-5xl text-primary-300 mb-4"></i>
    <h3 class="text-xl font-semibold text-primary-800 mb-2">Kategori Tidak Ditemukan</h3>
    <p class="text-primary-600 mb-4">Tidak ada kategori yang sesuai dengan pencarian Anda.</p>
    <button id="reset-search" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors duration-300 inline-flex items-center">
        <i class="fas fa-redo-alt mr-2"></i>
        Reset Pencarian
    </button>
</div>

<script>
    // Simple search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-categories');
        const categoriesContainer = document.getElementById('categories-container');
        const categoryCards = document.querySelectorAll('.category-card');
        const emptyState = document.getElementById('empty-state');
        const resetButton = document.getElementById('reset-search');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            let visibleCount = 0;
            
            categoryCards.forEach(card => {
                const categoryName = card.getAttribute('data-category-name');
                if (categoryName.includes(searchTerm)) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });
            
            if (visibleCount === 0) {
                categoriesContainer.classList.add('hidden');
                emptyState.classList.remove('hidden');
            } else {
                categoriesContainer.classList.remove('hidden');
                emptyState.classList.add('hidden');
            }
        });
        
        resetButton.addEventListener('click', function() {
            searchInput.value = '';
            categoryCards.forEach(card => card.classList.remove('hidden'));
            categoriesContainer.classList.remove('hidden');
            emptyState.classList.add('hidden');
        });
    });
</script>
@endsection