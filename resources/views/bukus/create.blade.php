@extends('layouts.app')

@section('content')
    <h1>Tambah Buku Baru</h1>

    <form action="{{ route('bukus.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="judul">Judul Buku</label>
            <input type="text" name="judul" id="judul" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="penulis">Penulis Buku</label>
            <input type="text" name="penulis" id="penulis" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Tambah Buku</button>
    </form>
@endsection
