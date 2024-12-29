<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuDataSeeder extends Seeder
{
    public function run()
    {
        // Add more dummy books data
        Buku::create([
            'judul' => 'Dummy Book 1',
            'penulis' => 'Author 1',
            'tersedia' => true,
        ]);

        Buku::create([
            'judul' => 'Dummy Book 2',
            'penulis' => 'Author 2',
            'tersedia' => false,
        ]);

        Buku::create([
            'judul' => 'Dummy Book 3',
            'penulis' => 'Author 3',
            'tersedia' => true,
        ]);

        Buku::create([
            'judul' => 'Dummy Book 4',
            'penulis' => 'Author 4',
            'tersedia' => true,
        ]);

        Buku::create([
            'judul' => 'Dummy Book 5',
            'penulis' => 'Author 5',
            'tersedia' => false,
        ]);

        Buku::create([
            'judul' => 'Dummy Book 6',
            'penulis' => 'Author 6',
            'tersedia' => true,
        ]);

        Buku::create([
            'judul' => 'Dummy Book 7',
            'penulis' => 'Author 7',
            'tersedia' => false,
        ]);

        Buku::create([
            'judul' => 'Dummy Book 8',
            'penulis' => 'Author 8',
            'tersedia' => true,
        ]);

        Buku::create([
            'judul' => 'Dummy Book 9',
            'penulis' => 'Author 9',
            'tersedia' => true,
        ]);

        Buku::create([
            'judul' => 'Dummy Book 10',
            'penulis' => 'Author 10',
            'tersedia' => false,
        ]);
    }
}

