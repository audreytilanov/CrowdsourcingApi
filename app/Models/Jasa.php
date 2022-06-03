<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    use HasFactory;

    protected $fillable=[
        'nama',
        'deskripsi',
        'harga',
        'paket_jasa_id',
        'kategori_id',
    ];

    public function paketjasas(){
        return $this->belongsTo(PaketJasa::class, 'paket_jasa_id', 'id');
    }

    public function kategoris(){
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function rincianjasas(){
        return $this->hasMany(RincianJasa::class, 'jasa_id', 'id');
    }
}
