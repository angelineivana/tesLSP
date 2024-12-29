@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-4">Daftar Buku</h1>
    <a href="{{ route('bukus.create') }}" class="btn btn-primary mb-3">Tambah Buku</a>
    
    <table class="table table-striped shadow">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bukus as $buku)
                <tr>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('bukus.edit', $buku->id) }}" class="btn btn-warning">Edit</a>

                        <!-- Delete Form -->
                        <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST" style="display:inline;">
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
