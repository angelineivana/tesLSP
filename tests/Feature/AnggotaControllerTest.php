<?php

namespace Tests\Feature;

use App\Models\Anggota;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnggotaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_view_with_anggotas()
    {
        // Arrange: Create some Anggota manually
        Anggota::create([
            'nama' => 'John Doe',
            'email' => 'john.doe@example.com',
            'telepon' => '1234567890',
        ]);
        Anggota::create([
            'nama' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'telepon' => '0987654321',
        ]);

        // Act: Send a GET request to the index method of AnggotaController
        $response = $this->get(route('anggotas.index'));

        // Assert: Check that the response is successful and contains Anggota data
        $response->assertStatus(200);
        $response->assertViewHas('anggotas');
        $this->assertCount(2, $response->viewData('anggotas'));
    }

    public function test_create_shows_create_form()
    {
        // Act: Send a GET request to the create method of AnggotaController
        $response = $this->get(route('anggotas.create'));

        // Assert: Check that the response is successful
        $response->assertStatus(200);
    }

    public function test_store_creates_anggota()
    {
        // Act: Send a POST request to the store method of AnggotaController with valid data
        $response = $this->post(route('anggotas.store'), [
            'nama' => 'John Doe',
            'email' => 'john.doe@example.com',
            'telepon' => '1234567890',
        ]);

        // Assert: Check that the Anggota was created and the redirect happened
        $response->assertRedirect(route('anggotas.index'));
        $this->assertDatabaseHas('anggotas', [
            'nama' => 'John Doe',
            'email' => 'john.doe@example.com',
        ]);
    }

    public function test_update_anggota()
    {
        // Arrange: Create an Anggota manually
        $anggota = Anggota::create([
            'nama' => 'John Doe',
            'email' => 'john.doe@example.com',
            'telepon' => '1234567890',
        ]);

        // Act: Send a PUT request to update the Anggota
        $response = $this->put(route('anggotas.update', $anggota), [
            'nama' => 'Updated Name',
            'email' => 'updated@example.com',
            'telepon' => '0987654321',
        ]);

        // Assert: Check that the Anggota was updated
        $response->assertRedirect(route('anggotas.index'));
        $this->assertDatabaseHas('anggotas', [
            'nama' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);
    }

    public function test_destroy_anggota()
    {
        // Arrange: Create an Anggota manually
        $anggota = Anggota::create([
            'nama' => 'John Doe',
            'email' => 'john.doe@example.com',
            'telepon' => '1234567890',
        ]);

        // Act: Send a DELETE request to remove the Anggota
        $response = $this->delete(route('anggotas.destroy', $anggota));

        // Assert: Check that the Anggota was deleted
        $response->assertRedirect(route('anggotas.index'));
        $this->assertDatabaseMissing('anggotas', [
            'id' => $anggota->id,
        ]);
    }
}
