@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Kategori untuk: {{ $buku->judul }}</h4>
                </div>
                <div class="card-body">
                    @if($buku->kategoris->count() > 0)
                        <div class="categories-list">
                            @foreach($buku->kategoris as $kategori)
                                <div class="badge bg-primary me-2 mb-2">
                                    {{ $kategori->nama }}
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Buku ini belum memiliki kategori</p>
                    @endif

                    <div class="mt-3">
                        <a href="{{ route('buku.kategori.index', $buku) }}" 
                           class="btn btn-primary">Manage Kategori</a>
                        <a href="{{ route('buku.show', $buku) }}" 
                           class="btn btn-secondary">Kembali ke Detail Buku</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection