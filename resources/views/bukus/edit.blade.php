@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-4">Edit Buku</h1>
    
    <form action="{{ route('bukus.update', $buku->id) }}" method="POST" class="shadow p-4 rounded">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Buku</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $buku->judul) }}" required>
        </div>

        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" name="penulis" id="penulis" class="form-control" value="{{ old('penulis', $buku->penulis) }}" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Perbarui Buku</button>
    </form>
@endsection
