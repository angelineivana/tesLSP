@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-4">Daftar Anggota</h1>
    <a href="{{ route('anggotas.create') }}" class="btn btn-primary mb-3">Tambah Anggota</a>
    
    <table class="table table-striped shadow">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anggotas as $anggota)
                <tr>
                    <td>{{ $anggota->nama }}</td>
                    <td>{{ $anggota->email }}</td>
                    <td>{{ $anggota->telepon }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('anggotas.edit', $anggota->id) }}" class="btn btn-warning">Edit</a>

                        <!-- Delete Form -->
                        <form action="{{ route('anggotas.destroy', $anggota->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
