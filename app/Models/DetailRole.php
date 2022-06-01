<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'pegawai_id',
    ];

    public function roles(){
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function pegawais(){
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }
}
