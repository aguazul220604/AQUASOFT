<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro_reservaciones extends Model
{
    public $timestamps = false;
    protected $table = 'registro_reservaciones';
    protected $fillable = [
        'id',
    ];
    public function gestionReservaciones()
    {
        return $this->hasMany(Gestion_reservaciones::class, 'id_reservacion', 'id');
    }
}
