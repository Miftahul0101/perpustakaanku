@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Daftar Peminjaman Saya</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($borrows as $borrow)
                            <tr>
                                <td>{{ $borrow->buku->judul }}</td>
                                <td>{{ $borrow->tanggal_pinjam }}</td>
                                <td>{{ $borrow->tanggal_kembali }}</td>
                                <td>{{ $borrow->status }}</td>
                                <td>
                                    @if($borrow->denda > 0)
                                        <span class="text-danger">Rp {{ number_format($borrow->denda, 0, ',', '.') }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection