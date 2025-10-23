<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\Payment;
use App\Models\Novedades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cabins;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function tickets(Request $request)
    {
        // Autenticación del usuario con acceso
        $usuario = Auth::user();
        $servicetype = $request->service_type;

        // Validación de servicios
        $valid_services = [
            1 => 'service1',
            2 => 'service2',
            3 => 'service3',
        ];

        // Creación de la matriz encargada de procesar los datos del ticket
        $selectedtickets = collect();

        // Análisis de información del ticket y comparativa de identificadores
        if ($servicetype && array_key_exists($servicetype, $valid_services)) {
            // Consultar información relativa al servicio especificado
            $selectedtickets = Tickets::where('estado', 1)
                ->where('service', $valid_services[$servicetype])
                ->selectRaw("*, SUBSTRING(service, 8) as service_number")
                ->get();
        }

        // Consultar la fecha en curso
        $today = now()->toDateString();

        // Consulta de información de tickets escaneados en la fecha en curso
        $tickets = Tickets::where('estado', 1)
            ->whereDate('fecha_escanner', $today)
            ->selectRaw("*, SUBSTRING(service, 8) as service_number")
            ->get();

        return view('admin.tickets', compact('tickets', 'selectedtickets', 'servicetype', 'usuario'));
    }

    public function payments()
    {
        // Autenticación del usuario con acceso
        $usuario = Auth::user();

        // Determinar los meses del año correspondiente
        $month = now()->format('m');
        $months = [
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',
        ];
        // Obtener el mes em curso actual
        $date = $months[$month];
        $year = now()->format('Y');

        // Consulta de información conjunta relativa a la información de los pagos realizados por servicio:

        // Servicio: Albercas
        $pagos_albercas = Payment::join('tickets', 'payments.stripe_payment_id', '=', 'tickets.id_pago')
            ->join('registro_albercas', 'payments.stripe_payment_id', '=', 'registro_albercas.id_pago')
            ->where('tickets.service', 'service1')
            ->whereYear('payments.created_at', $year)
            ->whereMonth('payments.created_at', $month)
            ->orderBy('payments.created_at', 'desc')
            ->get(['payments.*', 'tickets.*', 'registro_albercas.*']);

        // Servicio: Cabañas
        $pagos_cabins = Payment::join('tickets', 'payments.stripe_payment_id', '=', 'tickets.id_pago')
            ->join('servicios_extra', 'tickets.id', '=', 'servicios_extra.id_ticket')
            ->join('horarios_se', 'horarios_se.id', '=', 'servicios_extra.id_hora')
            ->where('tickets.service', 'service2')
            ->whereYear('payments.created_at', $year)
            ->whereMonth('payments.created_at', $month)
            ->orderBy('payments.created_at', 'desc')
            ->get();

        // Servicio: Camping
        $pagos_camping = Payment::join('tickets', 'payments.stripe_payment_id', '=', 'tickets.id_pago')
            ->join('registro_camping', 'payments.stripe_payment_id', '=', 'registro_camping.id_pago')
            ->where('tickets.service', 'service3')
            ->whereYear('payments.created_at', $year)
            ->whereMonth('payments.created_at', $month)
            ->orderBy('payments.created_at', 'desc')
            ->get(['payments.*', 'tickets.*', 'registro_camping.*']);

        // Conjunto de pagos totales
        $pagos_totales = Payment::join('tickets', 'payments.stripe_payment_id', '=', 'tickets.id_pago')
            ->orderBy('payments.created_at', 'desc')
            ->get(['payments.*', 'tickets.*']);


        return view('admin.payments', compact('date', 'year', 'pagos_albercas', 'pagos_cabins', 'pagos_camping', 'usuario', 'pagos_totales'));
    }

    public function reservations(Request $request)
    {
        // Autenticación del usuario con acceso
        $usuario = Auth::user();

        // Consulta de información sobre el estatus de reservación de las cabañas
        $estatus = Cabins::all();

        // Determinar los meses del año correspondiente
        $month = now()->format('m');
        $months = [
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',
        ];
        // Obtener el mes em curso actual
        $date = $months[$month];
        $year = now()->format('Y');

        // Creación de la matriz encargada de procesar los datos de la reservación
        $reservaciones_totales = collect();

        if ($request->time == 2) {
            // Consulta general de las reservaciones cuyo estado aún no ha sido procesado: Sin lectura
            $reservaciones_totales = DB::table('registro_reservaciones')
                ->join('gestion_reservaciones', 'registro_reservaciones.id', '=', 'gestion_reservaciones.id_reservacion')
                ->select(
                    'registro_reservaciones.id',
                    'registro_reservaciones.id_pago',
                    'registro_reservaciones.fecha_ingreso',
                    'registro_reservaciones.fecha_egreso',
                    'registro_reservaciones.cantidad_personas',
                    'registro_reservaciones.cantidad_dias',
                    DB::raw('GROUP_CONCAT(gestion_reservaciones.id_cabin) as id_cabins'),
                    DB::raw('GROUP_CONCAT(gestion_reservaciones.tipo_cabin) as tipo_cabins'),
                    DB::raw('GROUP_CONCAT(gestion_reservaciones.personas_extra) as personas_extras')
                )->where('registro_reservaciones.estado', 0)
                ->groupBy(
                    'registro_reservaciones.id',
                    'registro_reservaciones.id_pago',
                    'registro_reservaciones.fecha_ingreso',
                    'registro_reservaciones.fecha_egreso',
                    'registro_reservaciones.cantidad_personas',
                    'registro_reservaciones.cantidad_dias'
                )->orderBy('registro_reservaciones.fecha_ingreso')
                ->get();
        }
        // Consulta específica de las reservaciones en el mes actual
        $reservaciones = DB::table('registro_reservaciones')
            ->join('gestion_reservaciones', 'registro_reservaciones.id', '=', 'gestion_reservaciones.id_reservacion')
            ->select(
                'registro_reservaciones.id',
                'registro_reservaciones.id_pago',
                'registro_reservaciones.fecha_ingreso',
                'registro_reservaciones.fecha_egreso',
                'registro_reservaciones.cantidad_personas',
                'registro_reservaciones.cantidad_dias',
                DB::raw('GROUP_CONCAT(gestion_reservaciones.id_cabin) as id_cabins'),
                DB::raw('GROUP_CONCAT(gestion_reservaciones.tipo_cabin) as tipo_cabins'),
                DB::raw('GROUP_CONCAT(gestion_reservaciones.personas_extra) as personas_extras')
            )->whereMonth('registro_reservaciones.fecha_ingreso', $month)->whereYear('registro_reservaciones.fecha_ingreso', $year)->where('registro_reservaciones.estado', 0)
            ->groupBy(
                'registro_reservaciones.id',
                'registro_reservaciones.id_pago',
                'registro_reservaciones.fecha_ingreso',
                'registro_reservaciones.fecha_egreso',
                'registro_reservaciones.cantidad_personas',
                'registro_reservaciones.cantidad_dias'
            )->orderBy('registro_reservaciones.fecha_ingreso')
            ->get();

        return view('admin.reservaciones', compact('usuario', 'date', 'year', 'reservaciones_totales', 'reservaciones', 'estatus'));
    }

    public function statistics()
    {
        // Autenticación del usuario con acceso
        $usuario = Auth::user();
        
        // Determinar los meses del año correspondiente
        $month = now()->format('m');
        $months = [
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',
        ];
        // Obtener el mes em curso actual
        $date = $months[$month];
        $year = now()->format('Y');

        // Convatenación de información relativa al pago de entradas para el servicio: albercas
        $data_ages = Payment::join('registro_albercas', 'payments.stripe_payment_id', '=', 'registro_albercas.id_pago')
            ->whereYear('payments.created_at', $year)
            ->whereMonth('payments.created_at', $month)
            ->get(['payments.*', 'registro_albercas.*']);

        // Determinar la sumatoria de la cantidad de personas para cada grupo poblacional
        $ages1sum = $data_ages->whereNotNull('cantidad_1')->sum('cantidad_1');
        $ages2sum = $data_ages->whereNotNull('cantidad_2')->sum('cantidad_2');
        $ages3sum = $data_ages->whereNotNull('cantidad_3')->sum('cantidad_3');

        // Obtener la suma total de personas
        $ages = [$ages1sum, $ages2sum, $ages3sum];

        // Convatenación de información relativa al pago de tickets
        $data_services = Payment::join('tickets', 'payments.stripe_payment_id', '=', 'tickets.id_pago')
            ->whereYear('payments.created_at', $year)
            ->whereMonth('payments.created_at', $month)
            ->get(['payments.*', 'tickets.service']);

        // Determinar la sumatoria de la cantidad de servicios registrados
        $service1count = $data_services->where('service', 'service1')->count();
        $service2count = $data_services->where('service', 'service2')->count();
        $service3count = $data_services->where('service', 'service3')->count();

        // Estimación de ganancias correspondientes a cada servicio
        $services = [$service1count, $service2count, $service3count];

        // Servicio: Albercas
        $service1sum = Payment::join('tickets', 'payments.stripe_payment_id', '=', 'tickets.id_pago')
            ->where('tickets.service', 'service1')
            ->whereYear('payments.created_at', $year)
            ->whereMonth('payments.created_at', $month)
            ->sum('payments.amount');

        // Servicio: Cabañas
        $service2sum = Payment::join('tickets', 'payments.stripe_payment_id', '=', 'tickets.id_pago')
            ->where('tickets.service', 'service2')
            ->whereYear('payments.created_at', $year)
            ->whereMonth('payments.created_at', $month)
            ->sum('payments.amount');

        // Servicio: Camping
        $service3sum = Payment::join('tickets', 'payments.stripe_payment_id', '=', 'tickets.id_pago')
            ->where('tickets.service', 'service3')
            ->whereYear('payments.created_at', $year)
            ->whereMonth('payments.created_at', $month)
            ->sum('payments.amount');

        $gains = [$service1sum, $service2sum, $service3sum];

        $sumsByMonth = [];

        // Obtencióm de ganancias por mes del año en curso
        foreach ($months as $num => $name) {
            $sum = Payment::join('tickets', 'payments.stripe_payment_id', '=', 'tickets.id_pago')
                ->whereYear('payments.created_at', $year)
                ->whereMonth('payments.created_at', $num)
                ->sum('payments.amount');

            $sumsByMonth[$name] = $sum;
        }
        return view('admin.estadisticas', compact('date', 'year', 'ages', 'services', 'gains', 'sumsByMonth', 'usuario'));
    }
}
