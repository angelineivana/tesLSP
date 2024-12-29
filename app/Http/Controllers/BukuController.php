<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // Show the list of books
    public function index()
    {
        $bukus = Buku::all();
        return view('bukus.index', compact('bukus'));
    }
    
    // Show form for creating a new book
    public function create()
    {
        return view('bukus.create');
    }

    // Store a newly created book
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
        ]);

        Buku::create($request->all());

        return redirect()->route('bukus.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    // Show the form for editing a book
    public function edit(Buku $buku)
    {
        return view('bukus.edit', compact('buku'));
    }

    // Update the specified book
    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
        ]);

        $buku->update($request->all());

        return redirect()->route('bukus.index')->with('success', 'Buku berhasil diperbarui!');
    }

    // Remove the specified book
    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('bukus.index')->with('success', 'Buku berhasil dihapus!');
    }
}
