<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'anggota_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_harus_kembali',
        'tanggal_kembali'
    ];

    protected $dates = ['tanggal_pinjam', 'tanggal_kembali', 'tanggal_harus_kembali'];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
    
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }    
}

