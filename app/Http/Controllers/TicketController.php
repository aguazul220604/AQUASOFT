<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Registro_reservaciones;
use App\Models\Gestion_reservaciones;
use App\Models\Cabins;


class TicketController extends Controller
{
    public function procesarTicket(Request $request)
    {
        // Reglas de validación para el procesamiento de los datos del formulario de lectura de tickets
        $validated = $request->validate([
            'id_pago' => 'required|string|exists:tickets,id_pago',
            'tipo_servicio' => 'required|string|in:service1,service2,service3',
        ]);

        // Asignación de campos para las variables de confirmación de información del ticket
        $id_pago = $validated['id_pago'];
        $tipo_servicio = $validated['tipo_servicio'];

        try {
            // Consulta de información para determinar que exista el registro en la base de datos
            $ticket = Tickets::where('id_pago', $id_pago)
                ->where('service', $tipo_servicio)
                ->first();

            if (!$ticket) {
                return redirect()->route('admin.tickets')->withErrors(['error' => 'El ticket no existe para este tipo de servicio.']);
            }

            // Actualización del estado del ticket
            $this->actualizarTicket($ticket);

            switch ($tipo_servicio) {
                case "service1":
                    return redirect()->route('admin.tickets')->with('message', 'ok1');
                case "service2":
                    return redirect()->route('admin.tickets')->with('message', 'ok2');
                case "service3":
                    return redirect()->route('admin.tickets')->with('message', 'ok3');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.tickets')->withErrors(['error' => 'Ocurrió un error: ' . $e->getMessage()]);
        }
    }
    private function actualizarTicket(Tickets $ticket)
    {
        // Determinar la fecha de escaner del ticket 
        $ticket->fecha_escanner = Carbon::now();
        // Modificar su estado a "escaneado"
        $ticket->estado = 1;
        $ticket->save();
    }

    public function procesarCabin(Request $request)
    {
        // Reglas de validación para el procesamiento de los datos del formulario de lectura de reservaciones
        $validated = $request->validate([
            'id_pago' => 'required|string|exists:tickets,id_pago',
        ]);

        // Asignación de la variable de confirmación de información de reservación
        $id_pago = $validated['id_pago'];

        try {
            // Consulta de información para determinar que exista el registro en la base de datos
            $cabin = Registro_reservaciones::where('id_pago', $id_pago)->first();

            if (!$cabin) {
                return redirect()->route('admin.reservaciones')->withErrors(['error' => 'El ticket no existe']);
            }

            // Modificar su estado a "escaneado"
            $cabin->estado = 1;
            $cabin->save();
            // Determinar la cantidad de personas que permite soportar el tipo de cabaña reservado y los turistas hospedados
            $gestiones = Gestion_reservaciones::where('id_reservacion', $cabin->id)->get();

            if ($gestiones->isEmpty()) {
                return redirect()->route('admin.reservaciones')->withErrors(['error' => 'No se encontraron gestiones para esta reservación']);
            }

            foreach ($gestiones as $gestion) {
                // Determinar el estado de reservación de la cabaña
                $available = Cabins::find($gestion->id_cabin);

                if ($available) {
                    $available->estatus = 0;
                    $available->save();
                }
            }

            return redirect()->route('admin.reservaciones')->with('message', 'ok');
        } catch (\Exception $e) {
            return redirect()->route('admin.reservaciones')->withErrors(['error' => 'Ocurrió un error: ' . $e->getMessage()]);
        }
    }
}
