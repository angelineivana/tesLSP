@extends('layouts.app')

@section('title', 'Katalog Buku')

@section('content')
    <style>
        .book-link {
            text-decoration: none; /* Remove underline from hyperlinks */
        }

        .book-link:hover {
            text-decoration: none; /* Optional: To keep no underline even on hover */
        }
    </style>

    <h1 class="text-center mb-4">Katalog Buku Perpustakaan</h1>
    <div class="row">
        @foreach($books as $book)
            <div class="col-md-4 mb-4">
                <a href="{{ route('peminjaman.create', ['book_id' => $book->id]) }}" 
                   class="book-link"
                   data-tersedia="{{ $book->tersedia }}">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->judul }}</h5> <!-- Assuming 'judul' for title -->
                            <p class="card-text">
                                <strong>Penulis:</strong> {{ $book->penulis }} <br> <!-- Assuming 'penulis' for author -->
                                <strong>Status:</strong> 
                                <span class="badge bg-{{ $book->tersedia ? 'success' : 'danger' }}">
                                    {{ $book->tersedia ? 'Tersedia' : 'Tidak Tersedia' }}
                                </span>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <script>
        // JavaScript to handle click event and show alert if the book is not available
        document.querySelectorAll('.book-link').forEach(function(link) {
            link.addEventListener('click', function(event) {
                var tersedia = event.currentTarget.getAttribute('data-tersedia');
                if (tersedia == 0) {
                    event.preventDefault(); // Prevent navigation
                    alert('Buku Tidak Tersedia!');
                }
            });
        });
    </script>
@endsection
