<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingSubGrup extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'mapping_grup_id',
        'detail_transaksi_id',
        'nama',
    ];

    public function transaksis(){
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }
    
    public function mappinggrups(){
        return $this->belongsTo(MappingGrup::class, 'mapping_grup_id', 'id');
    }
    
    public function detailtransaksis(){
        return $this->belongsTo(Transaksi::class, 'detail_transaksi_id', 'id');
    }
}
