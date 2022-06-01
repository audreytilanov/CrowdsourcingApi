<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingSubProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'mapping_sub_grup_id',
        'rincian_jasa_id',
        'pegawai_id',
        'persentasi_gaji',
        'sub_project',
    ];

    public function mappingsubgrups(){
        return $this->belongsTo(MappingSubGrup::class, 'mapping_sub_grup_id', 'id');
    }
    
    public function rincianjasas(){
        return $this->belongsTo(RincianJasa::class, 'rincian_jasa_id', 'id');
    }
    
    public function pegawai_id(){
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }
}
