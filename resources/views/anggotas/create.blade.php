@extends('layouts.app')

@section('content')
    <h1>Tambah Anggota Baru</h1>

    <form action="{{ route('anggotas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="telepon">Telepon</label>
            <input type="text" name="telepon" id="telepon" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Tambah Anggota</button>
    </form>
@endsection
