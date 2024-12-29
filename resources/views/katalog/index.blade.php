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

    <!-- Search and Filter Form -->
    <form method="GET" action="{{ route('katalog.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="judul" class="form-control" placeholder="Cari judul buku..." value="{{ request('judul') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="penulis" class="form-control" placeholder="Cari penulis..." value="{{ request('penulis') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Cari</button>
            </div>
        </div>
    </form>

    @if($books->isEmpty())
        <div class="alert alert-warning text-center">
            <strong>Tidak ada buku di katalog!</strong> Silakan tambahkan buku.
        </div>
        <div class="text-center">
            <a href="{{ route('bukus.create') }}" class="btn btn-primary">Tambah Buku</a>
        </div>
    @else
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

        <!-- Pagination Links - Only Previous and Next -->
        <div class="d-flex justify-content-center">
            <div class="pagination">
                <!-- Previous Button -->
                @if ($books->onFirstPage())
                    <span class="page-link disabled">Previous</span>
                @else
                    <a href="{{ $books->previousPageUrl() }}" class="page-link">Previous</a>
                @endif

                <!-- Next Button -->
                @if ($books->hasMorePages())
                    <a href="{{ $books->nextPageUrl() }}" class="page-link">Next</a>
                @else
                    <span class="page-link disabled">Next</span>
                @endif
            </div>
        </div>
    @endif

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
