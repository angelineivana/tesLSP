<?php

namespace Tests\Feature;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PeminjamanControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_view_with_loans()
    {
        // Arrange: Create some Buku and Anggota manually
        $book = Buku::create([
            'judul' => 'Book One',
            'penulis' => 'Author One',
            'tersedia' => 1,
        ]);
        $anggota = Anggota::create([
            'nama' => 'John Doe',
            'email' => 'john.doe@example.com',
            'telepon' => '1234567890',
        ]);

        Peminjaman::create([
            'buku_id' => $book->id,
            'anggota_id' => $anggota->id,
            'tanggal_pinjam' => now(),
            'tanggal_harus_kembali' => now()->addDays(7),
        ]);

        // Act: Send a GET request to the index method of PeminjamanController
        $response = $this->get(route('peminjaman.index'));

        // Assert: Check that the response is successful and contains Peminjaman data
        $response->assertStatus(200);
        $response->assertViewHas('loans');
        $this->assertCount(1, $response->viewData('loans'));
    }

    public function test_create_shows_create_form()
    {
        // Arrange: Create Buku and Anggota manually
        Buku::create([
            'judul' => 'Book One',
            'penulis' => 'Author One',
            'tersedia' => 1,
        ]);
        Anggota::create([
            'nama' => 'John Doe',
            'email' => 'john.doe@example.com',
            'telepon' => '1234567890',
        ]);

        // Act: Send a GET request to the create method of PeminjamanController
        $response = $this->get(route('peminjaman.create'));

        // Assert: Check that the response is successful
        $response->assertStatus(200);
    }

    public function test_store_creates_peminjaman()
    {
        // Arrange: Create Buku and Anggota manually
        $book = Buku::create([
            'judul' => 'Book One',
            'penulis' => 'Author One',
            'tersedia' => 1,
        ]);
        $anggota = Anggota::create([
            'nama' => 'John Doe',
            'email' => 'john.doe@example.com',
            'telepon' => '1234567890',
        ]);

        // Act: Send a POST request to the store method of PeminjamanController
        $response = $this->post(route('peminjaman.store'), [
            'buku_id' => $book->id,
            'anggota_id' => $anggota->id,
        ]);

        // Assert: Check that the Peminjaman was created and the redirect happened
        $response->assertRedirect(route('peminjaman.index'));
        $this->assertDatabaseHas('peminjamen', [
            'buku_id' => $book->id,
            'anggota_id' => $anggota->id,
        ]);
    }
}
