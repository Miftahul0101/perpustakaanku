{{-- resources/views/buku-kategoris/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Tambah Kategori Buku</h2>
                </div>

                <form action="{{ route('buku-kategoris.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="buku_id" class="block text-gray-700 text-sm font-bold mb-2">
                            Buku
                        </label>
                        <select name="buku_id" id="buku_id" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('buku_id') border-red-500 @enderror">
                            <option value="">Pilih Buku</option>
                            @foreach($bukus as $buku)
                                <option value="{{ $buku->id }}" {{ old('buku_id') == $buku->id ? 'selected' : '' }}>
                                    {{ $buku->judul }}
                                </option>
                            @endforeach
                        </select>
                        @error('buku_id')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Kategori (bisa pilih lebih dari satu)
                        </label>
                        <div class="mt-2 space-y-2">
                            @foreach($kategoris as $kategori)
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           name="kategori_ids[]" 
                                           value="{{ $kategori->id }}"
                                           id="kategori_{{ $kategori->id }}"
                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                           {{ (is_array(old('kategori_ids')) && in_array($kategori->id, old('kategori_ids'))) ? 'checked' : '' }}>
                                    <label for="kategori_{{ $kategori->id }}" class="ml-2 text-sm text-gray-600">
                                        {{ $kategori->nama }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('kategori_ids')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan
                        </button>
                        <a href="{{ route('buku-kategoris.index') }}" 
                           class="text-gray-600 hover:text-gray-800">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bukuSelect = document.getElementById('buku_id');
    const kategoriCheckboxes = document.querySelectorAll('input[name="kategori_ids[]"]');

    bukuSelect.addEventListener('change', async function() {
        const bukuId = this.value;
        if (!bukuId) return;

        try {
            const response = await fetch(`/api/buku/${bukuId}/kategoris`);
            const existingKategoris = await response.json();

            // Enable all checkboxes first
            kategoriCheckboxes.forEach(checkbox => {
                checkbox.disabled = false;
            });

            // Disable checkboxes for categories that are already assigned to the book
            existingKategoris.forEach(kategoriId => {
                const checkbox = document.querySelector(`input[value="${kategoriId}"]`);
                if (checkbox) {
                    checkbox.disabled = true;
                }
            });
        } catch (error) {
            console.error('Error fetching existing categories:', error);
        }
    });
});
</script>
@endpush
@endsection