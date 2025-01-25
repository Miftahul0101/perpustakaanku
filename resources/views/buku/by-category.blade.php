@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>Buku dalam Kategori: {{ $kategori->nama }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Kategori Lainnya</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($books as $book)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $book->judul }}</td>
                                        <td>
                                            @foreach($book->kategoris as $kat)
                                                @if($kat->id != $kategori->id)
                                                    <span class="badge bg-secondary">{{ $kat->nama }}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('buku.show', $book) }}" 
                                               class="btn btn-sm btn-info">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada buku</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection