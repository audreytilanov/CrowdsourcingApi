<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail',
        'link',
        'detail_transaksi_id',
    ];

    public function detailtransaksis(){
        return $this->belongsTo(DetailTransaksi::class, 'detail_transaksi_id', 'id');
    }
}
