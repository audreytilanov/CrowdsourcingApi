<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'jasa_id',
        'qty',
        'harga_total',
        'status',
    ];

    public function jasas(){
        return $this->belongsTo(Jasa::class, 'jasa_id', 'id');
    }

    public function materials(){
        return $this->hasOne(Material::class, 'detail_transaksi_id', 'id');
    }
}
