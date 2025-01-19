<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'status'; // Nama tabel
    protected $primaryKey = 'id_status'; // Primary key

    protected $fillable = [
        'id_status',
        'nama_status',
    ];

    // Relasi ke model Produk
    public function produk()
    {
        return $this->hasMany(Produk::class, 'status_id', 'id_status');
    }
}
