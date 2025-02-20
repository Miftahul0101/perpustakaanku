<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-6">Pengembalian Buku</h2>

                    <div class="mb-6">
                        <div class="max-w-xl">
                            <label for="search" class="block text-sm font-medium text-gray-700">Cari Mahasiswa</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="text" name="search" id="search" 
                                       class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" 
                                       placeholder="Masukkan nama mahasiswa">
                            </div>
                        </div>
                    </div>

                    <div id="searchResults" class="mt-6">
                        <!-- Results will be populated here via AJAX -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let searchTimeout;
        
        document.getElementById('search').addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const searchQuery = e.target.value;
                if (searchQuery.length >= 3) {
                    fetch(`/api/peminjaman/search?q=${searchQuery}`)
                        .then(response => response.json())
                        .then(data => {
                            const resultsDiv = document.getElementById('searchResults');
                            resultsDiv.innerHTML = '';

                            if (data.length > 0) {
                                const table = document.createElement('table');
                                table.className = 'min-w-full divide-y divide-gray-200';
                                // Add table headers and data here similar to peminjaman/index view
                            } else {
                                resultsDiv.innerHTML = '<p class="text-gray-500">Tidak ada hasil ditemukan</p>';
                            }
                        });
                }
            }, 500);
        });
    </script>