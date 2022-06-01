<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'type'
    ];

    public function transaksis(){
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }
}
