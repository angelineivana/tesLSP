<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Anggota;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Get all loans with the related book and member data
        $loans = Peminjaman::with('buku', 'anggota')
            ->orderByRaw('tanggal_kembali IS NULL DESC, tanggal_harus_kembali DESC') // Non-returned books first, then due dates
            ->get();

        // Parse tanggal_kembali if it's not null
        foreach ($loans as $loan) {
            if ($loan->tanggal_kembali) {
                $loan->tanggal_kembali = \Carbon\Carbon::parse($loan->tanggal_kembali);
            }
        }

        return view('peminjaman.index', compact('loans'));
    }

    // Show the create form for peminjaman
    public function create(Request $request)
    {
        // Get the selected book from the query parameter
        $selectedBook = Buku::find($request->get('book_id'));

        // Fetch all books that are available (tersedia = 1) and not borrowed (i.e., books without any active loans)
        $books = Buku::where('tersedia', 1) // Only available books
            ->whereDoesntHave('peminjaman', function($query) {
                $query->whereNull('tanggal_kembali'); // Check if the return date is null (not yet returned)
            })
            ->get();

        // Fetch all members to populate the form
        $members = Anggota::all();

        // Pass the selected book and filtered books to the view
        return view('peminjaman.create', compact('books', 'members', 'selectedBook'));
    }

    // Store a new loan
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',  // Matching column name buku_id
            'anggota_id' => 'required|exists:anggotas,id',  // Matching column name anggota_id
        ]);

        // Create a new loan entry
        $loan = new Peminjaman();
        $loan->buku_id = $request->buku_id; // Matching column name
        $loan->anggota_id = $request->anggota_id; // Matching column name
        $loan->tanggal_pinjam = now();
        $loan->tanggal_harus_kembali = now()->addDays(7); // 7 days from now
        $loan->save();

        // Update the book's availability status
        $book = Buku::find($request->buku_id);
        $book->tersedia = false;  // Change availability status to false (borrowed)
        $book->save();

        // Redirect with success message
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dicatat!');
    }

    public function returnBook($id)
    {
        // Find the loan record
        $loan = Peminjaman::findOrFail($id);
        
        // Update the loan with the return date
        $loan->tanggal_kembali = now();
        $loan->save();

        // Mark the book as available again
        $book = $loan->buku;
        $book->tersedia = true; // Set book availability back to true
        $book->save();

        return redirect()->route('peminjaman.index')->with('success', 'Buku berhasil dikembalikan!');
    }

}
