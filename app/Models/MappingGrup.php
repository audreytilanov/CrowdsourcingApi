<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingGrup extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'pegawai_id',
        'nama',
    ];

    public function transaksis(){
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }
    
    public function pegawais(){
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }

    public function mappingsubgrups(){
        return $this->hasMany(MappingSubGrup::class, 'mapping_grup_id', 'id');
    }
}
