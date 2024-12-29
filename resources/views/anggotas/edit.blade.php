@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-4">Edit Anggota</h1>
    
    <form action="{{ route('anggotas.update', $anggota->id) }}" method="POST" class="shadow p-4 rounded">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $anggota->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $anggota->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="text" name="telepon" id="telepon" class="form-control" value="{{ old('telepon', $anggota->telepon) }}" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Perbarui Anggota</button>
    </form>
@endsection
