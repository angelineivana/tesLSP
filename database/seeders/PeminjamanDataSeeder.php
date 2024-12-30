<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;  
use Carbon\Carbon; // Import Carbon for date manipulation

class PeminjamanDataSeeder extends Seeder
{
    public function run()
    {
        // Ensure that there are anggota (members) in the database
        $anggota = Anggota::all();

        // Check if there are members in the database
        if ($anggota->count() > 0) {
            $tanggalPinjam = Carbon::create(2024, 12, 21, 0, 0, 0); // December 21, 2024

            // Create loans with specific book IDs: 17, 20, 22, 25
            Peminjaman::create([
                'anggota_id' => $anggota->random()->id, // Random member
                'buku_id' => 2,  // Specific book ID
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_harus_kembali' => $tanggalPinjam->copy()->addDays(7), // Due 7 days from the borrow date
                'tanggal_kembali' => null, // Not yet returned
            ]);

            Peminjaman::create([
                'anggota_id' => $anggota->random()->id, // Random member
                'buku_id' => 5,  // Specific book ID
                'tanggal_pinjam' => now(),
                'tanggal_harus_kembali' => now()->addDays(7),
                'tanggal_kembali' => null, // Not yet returned
            ]);

            Peminjaman::create([
                'anggota_id' => $anggota->random()->id, // Random member
                'buku_id' => 7,  // Specific book ID
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_harus_kembali' => $tanggalPinjam->copy()->addDays(7),
                'tanggal_kembali' => null, // Not yet returned
            ]);

            Peminjaman::create([
                'anggota_id' => $anggota->random()->id, // Random member
                'buku_id' => 10,  // Specific book ID
                'tanggal_pinjam' => now(),
                'tanggal_harus_kembali' => now()->addDays(7),
                'tanggal_kembali' => null, // Not yet returned
            ]);
        }
    }
}
