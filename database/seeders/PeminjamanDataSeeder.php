<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use Carbon\Carbon;

class PeminjamanDataSeeder extends Seeder
{
    public function run()
    {
        $anggota = Anggota::all();

        if ($anggota->count() > 0) {
            $tanggalPinjam = Carbon::create(2024, 12, 21, 0, 0, 0);

            // Detect books with `tersedia = 0` in real-time
            $booksUnavailable = Buku::where('tersedia', 0)->get();

            foreach ($booksUnavailable as $book) {
                // Create a loan for each unavailable book
                Peminjaman::create([
                    'anggota_id' => $anggota->random()->id,
                    'buku_id' => $book->id,
                    'tanggal_pinjam' => $tanggalPinjam,
                    'tanggal_harus_kembali' => $tanggalPinjam->copy()->addDays(7),
                    'tanggal_kembali' => null,
                ]);

                // Optionally update the book back to available (if required)
                // $book->update(['tersedia' => 1]);
            }
        }
    }
}
