<?php

namespace App\Http\Controllers;

use App\Models\Novedades;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function novedades()
    {
        // Función encargada de mostrar las novedades actualizadas al usuario
        $noticias = novedades::all();
        return view('client.novedades', compact('noticias'));
    }
}
