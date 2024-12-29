<?php

namespace App\Http\Controllers;

use App\Models\Buku; // Assuming Buku is the model for books
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    // Display the catalog
    public function index()
    {
        $books = Buku::all(); // Fetch all books
        return view('katalog.index', compact('books'));
    }
}
