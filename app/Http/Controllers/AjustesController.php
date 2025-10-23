<?php

namespace App\Http\Controllers;

use App\Models\entradas_precio;
use App\Models\Cabins_precio;
use App\Models\Servicios_precio;
use App\Models\Descuentos;
use Illuminate\Support\Facades\Auth;



use Illuminate\Http\Request;

class AjustesController extends Controller
{
    public function settings(Request $request)
    {
        // Obtención del usuario autenticado
        $usuario = Auth::user();

        // Consulta de datos para gestión de ajustes
        $entradas = entradas_precio::all();
        $cabins = Cabins_precio::all();
        $servicios = Servicios_precio::all();
        $descuentos = Descuentos::all();

        //Retorno de vista al panel administrativo
        return view('admin.ajustes', compact('entradas', 'cabins', 'servicios', 'descuentos', 'usuario'));
    }


    public function updateEntradas(Request $request, string $id)
    {
        // Reglas de validación para actualización de entradas
        $entradas = $request->validate([
            'txtdescription' => 'required',
            'txtprecio' => 'required',
        ]);

        // Consulta y selección del ID correspondiente al precio
        $entradas = entradas_precio::find($id);
        $entradas->description = $request->input('txtdescription');
        $entradas->precio = $request->input('txtprecio');

        // Evaluación de la operación
        if ($entradas->save()) {
            return redirect()->route('admin.ajustes')->with('message', 'update1');
        } else {
            return redirect()->route('admin.ajustes')->with(['error' => 'error']);
        }
    }

    public function updateCabins(Request $request, string $id)
    {
        // Reglas de validación para actualización de cabañas
        $cabins = $request->validate([
            'txtdescription' => 'required',
            'txtprecio' => 'required',
        ]);

        // Consulta y selección del ID correspondiente al precio
        $cabins = Cabins_precio::find($id);
        $cabins->description = $request->input('txtdescription');
        $cabins->precio = $request->input('txtprecio');

        // Evaluación de la operación
        if ($cabins->save()) {
            return redirect()->route('admin.ajustes')->with('message', 'update2');
        } else {
            return redirect()->route('admin.ajustes')->with(['error' => 'error']);
        }
    }

    public function updateServicios(Request $request, string $id)
    {
        // Reglas de validación para actualización de servicios
        $servicios = $request->validate([
            'txtdescription' => 'required',
            'txtprecio' => 'required',
        ]);

        // Consulta y selección del ID correspondiente al precio
        $servicios = Servicios_precio::find($id);
        $servicios->description = $request->input('txtdescription');
        $servicios->precio = $request->input('txtprecio');

        // Evaluación de la operación
        if ($servicios->save()) {
            return redirect()->route('admin.ajustes')->with('message', 'update3');
        } else {
            return redirect()->route('admin.ajustes')->with(['error' => 'error']);
        }
    }
    public function updateDescuentos(Request $request)
    {
        // Reglas de validación para actualización de descuentos
        $validated = $request->validate([
            'albercas_id' => 'required|numeric|exists:descuentos,id',
            'albercas_entradas' => 'required|numeric|min:0',
            'albercas_monto' => 'required|numeric|min:0',
            'camping_id' => 'required|numeric|exists:descuentos,id',
            'camping_entradas' => 'required|numeric|min:0',
            'camping_monto' => 'required|numeric|min:0',
        ]);

        try {
            // Consulta y selección del ID correspondiente al precio
            $descuentoAlbercas = Descuentos::findOrFail($validated['albercas_id']);
            $descuentoAlbercas->entradas = $validated['albercas_entradas'];
            $descuentoAlbercas->monto = $validated['albercas_monto'];
            $descuentoAlbercas->save();

            // Consulta y selección del ID correspondiente al precio
            $descuentoCamping = Descuentos::findOrFail($validated['camping_id']);
            $descuentoCamping->entradas = $validated['camping_entradas'];
            $descuentoCamping->monto = $validated['camping_monto'];
            $descuentoCamping->save();

            // Evaluación de la operación
            return redirect()->route('admin.ajustes')->with('message', 'update4');
        } catch (\Exception $e) {
            return redirect()->route('admin.ajustes')->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
}
