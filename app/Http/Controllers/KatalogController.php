<?php

namespace App\Http\Controllers;

use App\Models\Buku; // Assuming Buku is the model for books
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    // Display the catalog with search and filter functionality
    public function index(Request $request)
    {
        $query = Buku::query();

        if ($request->has('judul') && $request->judul != '') {
            $query->where('judul', 'like', '%' . $request->judul . '%');
        }

        if ($request->has('penulis') && $request->penulis != '') {
            $query->where('penulis', 'like', '%' . $request->penulis . '%');
        }

        // Fetch the filtered books, paginated for better performance
        $books = $query->paginate(9); // Adjust the number for pagination as needed

        return view('katalog.index', compact('books'));
    }
}
