<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    // Show the list of members
    public function index()
    {
        $anggotas = Anggota::all();
        return view('anggotas.index', compact('anggotas'));
    }
    
    // Show form for creating a new member
    public function create()
    {
        return view('anggotas.create');
    }

    // Store a newly created member
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:anggotas,email',
            'telepon' => 'required|string|max:20',
        ]);

        Anggota::create($request->all());

        return redirect()->route('anggotas.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    // Show the form for editing a member
    public function edit(Anggota $anggota)
    {
        return view('anggotas.edit', compact('anggota'));
    }

    // Update the specified member
    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:anggotas,email,' . $anggota->id,
            'telepon' => 'required|string|max:20',
        ]);

        $anggota->update($request->all());

        return redirect()->route('anggotas.index')->with('success', 'Anggota berhasil diperbarui!');
    }

    // Remove the specified member
    public function destroy(Anggota $anggota)
    {
        $anggota->delete();

        return redirect()->route('anggotas.index')->with('success', 'Anggota berhasil dihapus!');
    }
}
