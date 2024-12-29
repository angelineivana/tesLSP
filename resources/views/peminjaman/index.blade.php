@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
    <h1 class="text-center mb-4">Daftar Peminjaman Buku</h1>
    <button class="btn btn-primary mb-3" onclick="window.location.href='{{ route('peminjaman.create') }}'">Pinjam Buku</button>
    <table class="table table-striped shadow">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul Buku</th>
                <th>Nama Anggota</th>
                <th>Tanggal Pinjam</th>
                <th>Batas Kembali</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $loan)
                @php
                    // Check if the book is overdue
                    $isOverdue = $loan->tanggal_kembali === null && \Carbon\Carbon::parse($loan->tanggal_harus_kembali)->isPast();
                @endphp
                <tr class="{{ $isOverdue ? 'table-danger' : '' }}"> <!-- Highlight overdue books with a red background -->
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $loan->buku->judul }}</td>
                    <td>{{ $loan->anggota->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($loan->tanggal_pinjam)->format('d-m-Y') }}</td>
                    <td>
                        @if($loan->tanggal_harus_kembali)
                            {{ \Carbon\Carbon::parse($loan->tanggal_harus_kembali)->format('d-m-Y') }}
                            @if($isOverdue)
                                <span class="badge bg-danger">Terlambat</span> <!-- Show overdue status -->
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($loan->tanggal_kembali === null) <!-- Check if the book hasn't been returned yet -->
                            <form action="{{ route('peminjaman.kembalikan', $loan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary">Kembalikan</button>
                            </form>
                        @else
                            <span class="badge bg-success">Sudah Dikembalikan</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
