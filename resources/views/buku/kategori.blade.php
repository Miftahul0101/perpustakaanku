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

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Kelola Kategori: {{ $buku->judul }}</h2>
                    <a href="{{ route('buku.show', $buku) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Kembali
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('buku.kategori.assign', $buku) }}" method="POST" class="mb-6">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Kategori:</label>
                        <select name="kategori_ids[]" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" multiple required>
                            @foreach($allKategoris as $kategori)
                                <option value="{{ $kategori->id }}" 
                                    {{ $buku->kategoris->contains($kategori->id) ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Simpan Kategori
                    </button>
                </form>

                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-3">Kategori Saat Ini:</h3>
                    <div class="flex flex-wrap gap-2">
                        @forelse($buku->kategoris as $kategori)
                            <div class="inline-flex items-center bg-blue-100 rounded-full px-3 py-1">
                                <span class="text-blue-800">{{ $kategori->nama }}</span>
                                <form action="{{ route('buku.kategori.remove', [$buku, $kategori]) }}" 
                                      method="POST" class="ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-500 hover:text-red-700"
                                            onclick="return confirm('Yakin hapus kategori ini?')">
                                        ×
                                    </button>
                                </form>
                            </div>
                        @empty
                            <p class="text-gray-500 italic">Belum ada kategori</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
</body>
</html>