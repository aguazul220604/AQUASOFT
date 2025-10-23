<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Novedades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NovedadesController extends Controller
{
    public function novedades()
    {
        // Autenticación del usuario
        $usuario = Auth::user();
        // Consulta de información en la base de datos
        $noticias = novedades::all();
        // Retorno de la vista al panel administrativo
        return view('admin.novedades', compact('usuario', 'noticias'));
    }

    public function createNovedades(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'Descripcion' => 'required|string|max:500',
            'Imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Manejar la subida de la imagen
        if ($request->hasFile('Imagen')) {
            // Generar un nombre único para la imagen
            $imageName = Str::random(10) . '.' . $request->file('Imagen')->getClientOriginalExtension();

            // Mover la imagen a public/images con el nombre único
            $imagePath = $request->file('Imagen')->move(public_path('images'), $imageName);
        } else {
            $imagePath = null; // Si no se sube imagen
        }

        // Crear nueva instancia de registro
        $novedad = new novedades();
        $novedad->descripcion = $request->input('Descripcion');
        $novedad->img = 'images/' . $imageName;

        // Evaluación del registro
        if ($novedad->save()) {
            return back()->with('message', 'ok');
        }
        return back()->with('message', 'error');
    }

    public function editNovedades(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'Descripcion' => 'nullable|string|max:500',
            'Imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ID' => 'required|exists:novedades,id' // Asegurar que el ID existe en la BD
        ]);

        // Buscar el ID
        $novedad = Novedades::find($request->input('ID'));

        if (!$novedad) {
            return back()->with('message', 'not_found');
        }

        // Manejar la subida de la imagen
        if ($request->hasFile('Imagen')) {
            // Eliminar imagen anterior si existe
            if ($novedad->img && file_exists(public_path($novedad->img))) {
                unlink(public_path($novedad->img));
            }

            // Generar un nombre único para la imagen
            $imageName = Str::random(10) . '.' . $request->file('Imagen')->getClientOriginalExtension();

            // Mover la imagen a public/images
            $request->file('Imagen')->move(public_path('images'), $imageName);

            // Asignar la nueva ruta de la imagen
            $novedad->img = 'images/' . $imageName;
        }

        // Actualizar la descripción si se proporciona
        if ($request->has('Descripcion')) {
            $novedad->descripcion = $request->input('Descripcion');
        }

        // Guardar cambios
        if ($novedad->save()) {
            return back()->with('message', 'update');
        }

        return back()->with('message', 'error');
    }
    
    public function deleteNovedades($id)
    {
        $novedad = Novedades::findOrFail($id);

        // Verificar si el registro tiene una imagen
        if ($novedad->img) {
            $imagePath = public_path($novedad->img); // Ruta completa de la imagen

            // Comprobar si la imagen existe en el servidor antes de eliminarla
            if (file_exists($imagePath)) {
                unlink($imagePath); // Eliminar la imagen
            }
        }

        // Eliminar el registro de la base de datos
        $novedad->delete();

        return back()->with('message', 'deleted');
    }
}
