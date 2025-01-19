<?php

namespace App\Models;

use App\Models\Status;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $primaryKey = 'id_produk'; 

    protected $fillable = [
        'id_produk',
        'nama_produk',
        'harga',
        'kategori_id',
        'status_id',
    ];

    // Relasi ke model Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori');
    }

    // Relasi ke model Status
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id_status');
    }
}
