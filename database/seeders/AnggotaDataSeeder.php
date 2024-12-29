<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Anggota;

class AnggotaDataSeeder extends Seeder
{
    public function run()
    {
        // Add dummy members data
        Anggota::create([
            'nama' => 'Anggota 1',
            'email' => 'anggota1@example.com',
            'telepon' => '081234567890',
        ]);

        Anggota::create([
            'nama' => 'Anggota 2',
            'email' => 'anggota2@example.com',
            'telepon' => '081234567891',
        ]);

        Anggota::create([
            'nama' => 'Anggota 3',
            'email' => 'anggota3@example.com',
            'telepon' => '081234567892',
        ]);

        Anggota::create([
            'nama' => 'Anggota 4',
            'email' => 'anggota4@example.com',
            'telepon' => '081234567893',
        ]);

        Anggota::create([
            'nama' => 'Anggota 5',
            'email' => 'anggota5@example.com',
            'telepon' => '081234567894',
        ]);
    }
}

