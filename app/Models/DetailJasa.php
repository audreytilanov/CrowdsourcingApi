<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailJasa extends Model
{
    use HasFactory;

    protected $fillable = [
        'skill_id',
        'rincian_jasa_id',
        'pegawai_id',
    ];

    public function skills(){
        return $this->belongsTo(Skill::class, 'skill_id', 'id');
    }

    public function rincianjasas(){
        return $this->belongsTo(RincianJasa::class, 'rincian_jasa_id', 'id');
    }

    public function pegawais(){
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }
}
