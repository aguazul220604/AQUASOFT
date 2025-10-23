<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro_albercas extends Model
{
    public $timestamps = false;
    protected $table = 'registro_albercas';
    protected $fillable = [
        'id',
    ];
}
