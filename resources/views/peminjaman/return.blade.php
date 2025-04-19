{{-- resources/views/peminjaman/return.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Proses Pengembalian Buku</h5>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-light">Kembali</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Cari Peminjaman</h6>
                                    <form action="{{ route('peminjaman.return') }}" method="GET" class="d-flex">
                                        <input type="text" name="search" placeholder="ID Peminjaman / NIM / Nama" class="form-control me-2">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Mahasiswa</th>
                                    <th>Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                    <th>Denda Terkini</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($peminjaman as $pinjam)
                                    <tr class="{{ now() > $pinjam->tanggal_kembali ? 'table-danger' : '' }}">
                                        <td>{{ $pinjam->id }}</td>
                                        <td>
                                            {{ $pinjam->user->name }}
                                            <small class="d-block text-muted">{{ $pinjam->user->nim ?? '-' }}</small>
                                        </td>
                                        <td>
                                            <strong>{{ $pinjam->buku->judul }}</strong>
                                            <small class="d-block text-muted">{{ $pinjam->buku->penulis }}</small>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d/m/Y') }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($pinjam->tanggal_kembali)->format('d/m/Y') }}
                                            @if(now() > $pinjam->tanggal_kembali)
                                                <span class="badge bg-danger">Terlambat {{ now()->diffInDays($pinjam->tanggal_kembali) }} hari</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-warning">{{ ucfirst($pinjam->status) }}</span>
                                        </td>
                                        <td>
                                            @if($pinjam->current_denda > 0)
                                                <span class="text-danger fw-bold">
                                                    Rp {{ number_format($pinjam->current_denda, 0, ',', '.') }}
                                                </span>
                                            @else
                                                <span class="text-success">Tidak ada denda</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('peminjaman.processReturn') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="peminjaman_id" value="{{ $pinjam->id }}">
                                                <button type="submit" class="btn btn-success" onclick="return confirm('Proses pengembalian buku ini? {{ $pinjam->current_denda > 0 ? 'Denda sebesar Rp '.number_format($pinjam->current_denda, 0, ',', '.').' akan dibebankan.' : '' }}')">
                                                    Proses Pengembalian
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada peminjaman aktif</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection