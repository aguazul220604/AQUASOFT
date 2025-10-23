<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestion_reservaciones extends Model
{
    public $timestamps = false;
    protected $table = 'gestion_reservaciones';
    public function registroReservacion()
    {
        return $this->belongsTo(Registro_reservaciones::class, 'id_reservacion', 'id');
    }
}
