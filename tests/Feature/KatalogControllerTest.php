<?php

namespace Tests\Feature;

use App\Models\Buku;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KatalogControllerTest extends TestCase
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

        // Act: Send a GET request to the index method of KatalogController
        $response = $this->get(route('katalog.index'));

        // Assert: Check that the response is successful and contains Buku data
        $response->assertStatus(200);
        $response->assertViewHas('books');
        $this->assertCount(2, $response->viewData('books'));
    }
}
