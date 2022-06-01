<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'user_id',
        'pegawai_id',
        'kategori_id',
        'jumlah_harga',
        'status',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pegawais(){
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }

    public function kategoris(){
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
}
