<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori'; // Nama tabel
    protected $primaryKey = 'id_kategori'; // Primary key

    protected $fillable = [
        'id_kategori',
        'nama_kategori',
    ];

    // Relasi ke model Produk
    public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori_id', 'id_kategori');
    }
}
