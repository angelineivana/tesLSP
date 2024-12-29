<?php

namespace Tests\Feature;

use App\Models\Buku;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BukuControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_view_with_books()
    {
        // Arrange: Create some Buku manually
        Buku::create([
            'judul' => 'Book One',
            'penulis' => 'Author One',
        ]);
        Buku::create([
            'judul' => 'Book Two',
            'penulis' => 'Author Two',
        ]);

        // Act: Send a GET request to the index method of BukuController
        $response = $this->get(route('bukus.index'));

        // Assert: Check that the response is successful and contains Buku data
        $response->assertStatus(200);
        $response->assertViewHas('bukus');
        $this->assertCount(2, $response->viewData('bukus'));
    }

    public function test_create_shows_create_form()
    {
        // Act: Send a GET request to the create method of BukuController
        $response = $this->get(route('bukus.create'));

        // Assert: Check that the response is successful
        $response->assertStatus(200);
    }

    public function test_store_creates_buku()
    {
        // Act: Send a POST request to the store method of BukuController with valid data
        $response = $this->post(route('bukus.store'), [
            'judul' => 'New Book',
            'penulis' => 'New Author',
        ]);

        // Assert: Check that the Buku was created and the redirect happened
        $response->assertRedirect(route('bukus.index'));
        $this->assertDatabaseHas('bukus', [
            'judul' => 'New Book',
            'penulis' => 'New Author',
        ]);
    }

    public function test_update_buku()
    {
        // Arrange: Create a Buku manually
        $buku = Buku::create([
            'judul' => 'Book One',
            'penulis' => 'Author One',
        ]);

        // Act: Send a PUT request to update the Buku
        $response = $this->put(route('bukus.update', $buku), [
            'judul' => 'Updated Book',
            'penulis' => 'Updated Author',
        ]);

        // Assert: Check that the Buku was updated
        $response->assertRedirect(route('bukus.index'));
        $this->assertDatabaseHas('bukus', [
            'judul' => 'Updated Book',
            'penulis' => 'Updated Author',
        ]);
    }

    public function test_destroy_buku()
    {
        // Arrange: Create a Buku manually
        $buku = Buku::create([
            'judul' => 'Book One',
            'penulis' => 'Author One',
        ]);

        // Act: Send a DELETE request to remove the Buku
        $response = $this->delete(route('bukus.destroy', $buku));

        // Assert: Check that the Buku was deleted
        $response->assertRedirect(route('bukus.index'));
        $this->assertDatabaseMissing('bukus', [
            'id' => $buku->id,
        ]);
    }
}
