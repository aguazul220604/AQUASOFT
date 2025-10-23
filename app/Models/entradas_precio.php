<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entradas_precio extends Model
{
    use HasFactory;

    protected $table = 'entradas_precio';

    protected $fillable = ['description', 'precio'];

    public $timestamps = false;
}
