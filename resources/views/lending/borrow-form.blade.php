@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Form Peminjaman Buku</div>
                <div class="card-body">
                    <div class="book-details mb-4">
                        <h4>{{ $book->judul }}</h4>
                        <p>Penulis: {{ $book->penulis }}</p>
                        <p>ISBN: {{ $book->isbn }}</p>
                        <p>Stok: {{ $book->stok }}</p>
                    </div>

                    <form method="POST" action="{{ route('borrow.process', $book->id) }}">
                        @csrf
                        <div class="form-group">
                            <label>Tanggal Pengembalian</label>
                            <input type="date" name="tanggal_kembali" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Pinjam Buku</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection