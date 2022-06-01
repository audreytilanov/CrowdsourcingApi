<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianJasa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jasa_id',
    ];

    public function jasas(){
        return $this->belongsTo(Jasa::class, 'jasa_id', 'id');
    }
}
