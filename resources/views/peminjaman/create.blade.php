@extends('layouts.app')

@section('title', 'Form Peminjaman Buku')

@section('content')
    <h1 class="text-center mb-4">Form Peminjaman Buku</h1>
    <form action="{{ route('peminjaman.store') }}" method="POST" class="shadow p-4 rounded">
        @csrf
        <div class="mb-3">
            <label for="book_id" class="form-label">Pilih Buku</label>
            <select name="buku_id" id="book_id" class="form-select" required>
                <option value="">-- Pilih Buku --</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ isset($selectedBook) && $selectedBook->id == $book->id ? 'selected' : '' }}>
                        {{ $book->judul }} - {{ $book->penulis }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="member_id" class="form-label">Pilih Anggota</label>
            <select name="anggota_id" id="member_id" class="form-select" required>
                <option value="">-- Pilih Anggota --</option>
                @foreach($members as $member)
                    <option value="{{ $member->id }}">{{ $member->nama }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Pinjam Buku</button>
    </form>
@endsection
