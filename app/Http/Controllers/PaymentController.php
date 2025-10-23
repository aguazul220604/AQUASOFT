<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\entradas_precio;
use App\Models\Servicios_precio;
use App\Models\Cabins_precio;
use App\Models\Cabins;
use App\Models\Descuentos;
use App\Models\Horarios_se;
use App\Models\Payment;
use App\Models\Registro_albercas;
use App\Models\Registro_camping;
use App\Models\Registro_reservaciones;
use App\Models\Gestion_reservaciones;
use App\Models\Tickets;
use App\Models\Servicios_extra;
use App\Mail\Service1Mail;
use App\Mail\Service2Mail;
use App\Mail\Service3Mail;


use Illuminate\Support\Facades\Mail;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function formulario()
    {
        /* Función encargada de proporcionar los datos necesarios para que los usuarios puedan
           utilizar el formulario de solicitud de servicios y realizar pagos para entradas. */
        $entradas = entradas_precio::select('precio')->get();
        $servicios = Servicios_precio::select('precio')->get();
        $cabins = Cabins_precio::all();
        $estatus = Cabins::where('estatus', 0)->get();
        $descuentos = Descuentos::all();
        $horarios = Horarios_se::all();

        return view('client.pagos', compact('entradas', 'servicios', 'cabins', 'estatus', 'descuentos', 'horarios'));
    }

    public function processPayment(Request $request)
    {
        /* Validaciones para el procesamiento de datos en el formulario de pago de
           servicios en la vista del cliente */
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'service' => 'required|in:service1,service2,service3',
        ]);

        /* Se obtienen los precios correspondientes a entradas, servicios y cabañas para
           su posterior uso en la gestión de los precios totales para los usuarios */
        $entradas = entradas_precio::pluck('precio')->toArray();
        $servicios = Servicios_precio::pluck('precio')->toArray();
        $cabins = Cabins_precio::pluck('precio')->toArray();

        if (count($entradas) < 3 || count($servicios) < 1 || count($cabins) < 3) {
            return redirect()->route('pagos.formulario')->withErrors(['error' => 'No se encontraron precios suficientes en la base de datos.']);
        }

        // Se declara un array que almacena las entradas para los diferentes atractivos del negocio
        [$entrada1, $entrada2, $entrada3] = $entradas;

        // Se declara un array para la gestión de servicios dicionales
        [$servicio1] = $servicios;
        $servicio = $request->service;

        try {
            switch ($servicio) {
                case 'service1':
                    /* Se determina si existe la presencia de solicitudes de entradas en cada tipo de entradas
                       de acuerdo con el rango de edad y se asigna 0 en caso de no haber solicitudes para evitar procesamientos innecesarios */
                    $subtotal1 = ($request->edad1 ?? 0) * $entrada1;
                    $subtotal2 = ($request->edad2 ?? 0) * $entrada2;
                    $subtotal3 = ($request->edad3 ?? 0) * $entrada3;
                    // Se determina el total correspondiente
                    $total1 = $subtotal1 + $subtotal2 + $subtotal3;

                    // Invocación al método del pago para enviar el monto a Stripe
                    $payment = $this->processStripePayment($request, $total1);
                    // Con la información procesada se realiza el registro correspondiente en la base de datos(tabla: registro_albercas)
                    $this->createRegistroAlbercas($payment, $request, $entrada1, $entrada2, $entrada3);

                    // Generar código QR para la gestión de boletos digitales
                    $qrContent = $this->generateQrCode($payment->stripe_payment_id, $request->service);
                    $data = [$request->edad1, $subtotal1, $request->edad2, $subtotal2, $request->edad3, $subtotal3, $total1];

                    //Envío del ticket digital al correo del cliente
                    Mail::to($request->email)->send(new Service1Mail($payment->stripe_payment_id, $request->service, $qrContent, $data));

                    // Retornar a la vista del formulario de pago del cliente
                    return redirect()->route('pagos.formulario')->with('message', 'ok1');

                case 'service2':
                    // Obtener los datos de las entradas del formulario
                    $total2 = $request->total2;
                    // Invocación al método del pago para enviar el monto a Stripe
                    $payment = $this->processStripePayment($request, $total2);
                    $result = $this->createRegistroCabins($payment, $request);

                    // Generar código QR para la gestión de boletos digitales
                    $qrContent = $this->generateQrCode($payment->stripe_payment_id, $request->service);
                    $reservacion = Gestion_reservaciones::where('id_reservacion', $result['newId'])->get();
                    $data = [$result['registro2'], $reservacion];

                    //Envío del ticket digital al correo del cliente
                    Mail::to($request->email)->send(new Service2Mail($payment->stripe_payment_id, $request->service, $qrContent, $data));

                    // Retornar a la vista del formulario de pago del cliente
                    return redirect()->route('pagos.formulario')->with('message', 'ok2');

                case 'service3':
                    // Obtener los datos de las entradas del formulario
                    $total3 = ($request->numero_personas_camping ?? 0) * $servicio1;

                    // Invocación al método del pago para enviar el monto a Stripe
                    $payment = $this->processStripePayment($request, $total3);
                    $this->createRegistroCamping($payment, $request);

                    // Generar código QR para la gestión de boletos digitales
                    $qrContent = $this->generateQrCode($payment->stripe_payment_id, $request->service);
                    $data = [$request->numero_personas_camping, $total3];

                    //Envío del ticket digital al correo del cliente
                    Mail::to($request->email)->send(new Service3Mail($payment->stripe_payment_id, $request->service, $qrContent, $data));
                    
                    // Retornar a la vista del formulario de pago del cliente
                    return redirect()->route('pagos.formulario')->with('message', 'ok3');
            }
        } catch (\Exception $e) {
            return redirect()->route('pagos.formulario')->withErrors(['error' => 'Ocurrió un error: ' . $e->getMessage()]);
        }
    }
    
    private function processStripePayment(Request $request, $total)
    {
        // Uso de Stripe para procesar el pago de los datos del cliente
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $paymentIntent = PaymentIntent::create([
            'amount' => intval($total * 100),
            'currency' => 'mxn',
            'payment_method_types' => ['card'],
            'receipt_email' => $request->email,
        ]);
        // Registro del pago en la base de datos (tabla: payments)
        return Payment::create([
            'stripe_payment_id' => $paymentIntent->id,
            'name' => $request->name,
            'email' => $request->email,
            'amount' => $total,
            'created_at' => now(),
        ]);
    }

    private function createRegistroAlbercas($payment, Request $request, $entrada1, $entrada2, $entrada3)
    {
        // Obtención del monto económico de las entradas
        $subtotal1 = $request->edad1 * $entrada1;
        $subtotal2 = $request->edad2 * $entrada2;
        $subtotal3 = $request->edad3 * $entrada3;

        // Asignación de un identificador de servicio
        $maxNumber = Registro_albercas::where('id', 'LIKE', '%-ALBR')
            ->selectRaw('MAX(CAST(SUBSTRING(id, 1, LOCATE(\'-ALBR\', id) - 1) AS UNSIGNED)) AS max_number')
            ->value('max_number');

        $nextIdNumber = $maxNumber ? $maxNumber + 1 : 1;
        $newId = $nextIdNumber . '-ALBR';

        // Instancia de la tabla correspondiente para el registro de entradas: Albercas
        $registro = new Registro_albercas();

        $registro->id = $newId;
        $registro->id_pago = $payment->stripe_payment_id;
        $registro->cantidad_1 = $request->edad1;
        $registro->subtotal_1 = $subtotal1;
        $registro->cantidad_2 = $request->edad2;
        $registro->subtotal_2 = $subtotal2;
        $registro->cantidad_3 = $request->edad3;
        $registro->subtotal_3 = $subtotal3;
        $registro->descuentos = $request->entradas_gratis;
        $registro->monto_descuento = $request->monto_gratis;

        $registro->save();

        // Creación del ticket de compra
        $this->createTicket($payment->stripe_payment_id, 'service1', $request);
    }

    private function createRegistroCabins($payment, Request $request)
    {
        // Asignación de un identificador de servicio
        $maxNumber = Registro_reservaciones::where('id', 'LIKE', '%-CABS')
            ->selectRaw('MAX(CAST(SUBSTRING(id, 1, LOCATE(\'-CABS\', id) - 1) AS UNSIGNED)) AS max_number')
            ->value('max_number');

        $nextIdNumber = $maxNumber ? $maxNumber + 1 : 1;
        $newId = $nextIdNumber . '-CABS';

        // Establecimineto del rango de días de ocupación
        $fechaReservacion = Carbon::parse($request->fecha_reservacion);
        $diasReservacion = intval($request->dias_reservacion);
        $fechaIngreso = $fechaReservacion->setTime(12, 0, 0);
        $fechaEgreso = $fechaReservacion->copy()->addDays($diasReservacion)->setTime(12, 0, 0);

        // Instancia de la tabla correspondiente para el registro de entradas: Reservaciones (Cabañas)
        $registro2 = new Registro_reservaciones();

        $registro2->id = $newId;
        $registro2->id_pago = $payment->stripe_payment_id;
        $registro2->fecha_ingreso = $fechaIngreso;
        $registro2->fecha_egreso = $fechaEgreso;
        $registro2->cantidad_personas = $request->numero_personas_cabs;
        $registro2->cantidad_dias = $request->dias_reservacion;

        $registro2->save();

        // Asignación de estatus de ocupación de reservación para las cabañas
        $cabins = Cabins::where('estatus', 0)->get();
        $cantidadCabins = intval($request->cabs_reservadas);
        if ($cabins->count() < $cantidadCabins) {
            throw new \Exception('No hay suficientes cabañas disponibles');
        }

        $personas_extra = intval($request->personas_extra);
        $distribucion_pe = array_fill(0, $cantidadCabins, 0);
        for ($i = 0; $i < $personas_extra; $i++) {
            $distribucion_pe[$i % $cantidadCabins]++;
        }

        $cabinsSelected = $cabins->take($cantidadCabins);

        foreach ($cabinsSelected as $index => $cabin) {
            $gestion = new Gestion_reservaciones();
            $gestion->id_reservacion = $newId;
            $gestion->id_cabin = $cabin->id;
            $gestion->tipo_cabin = $request->tipo_cabs;
            $gestion->personas_extra = $distribucion_pe[$index];

            $gestion->save();
            $cabin->estatus = 1;
            $cabin->save();
        }

        $this->createTicket($payment->stripe_payment_id, 'service2', $request);
        return ['registro2' => $registro2, 'newId' => $newId];
    }

    private function createRegistroCamping($payment, Request $request)
    {
        // Asignación de un identificador de servicio
        $maxNumber = Registro_camping::where('id', 'LIKE', '%-CAMP')
            ->selectRaw('MAX(CAST(SUBSTRING(id, 1, LOCATE(\'-CAMP\', id) - 1) AS UNSIGNED)) AS max_number')
            ->value('max_number');

        $nextIdNumber = $maxNumber ? $maxNumber + 1 : 1;
        $newId = $nextIdNumber . '-CAMP';

        // Instancia de la tabla correspondiente para el registro de entradas: Camping
        $registro3 = new Registro_camping();

        $registro3->id = $newId;
        $registro3->id_pago = $payment->stripe_payment_id;
        $registro3->cantidad_personas = $request->numero_personas_camping;
        $registro3->descuentos = $request->entradas_gratis2;
        $registro3->monto_descuento = $request->monto_gratis2;

        $registro3->save();

        // Creación del ticket de compra
        $this->createTicket($payment->stripe_payment_id, 'service3', $request);
    }

    private function generateQrCode($paymentId, $service)
    {
        // Especificación de datos para la creación de tickets: ID de pago y servicio solicitado
        $qrData = $paymentId . $service;

        // Creación del código QR para el ticket digital
        $writer = new PngWriter();
        $qrCode = new QrCode(
            data: $qrData,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            foregroundColor: new Color(0, 0, 0),
            backgroundColor: new Color(255, 255, 255)
        );

        $result = $writer->write($qrCode);
        return $result->getString();
    }

    private function createTicket($paymentId, $service, Request $request)
    {
        // Registro de la información del ticket en la base de datos
        $ticket = new Tickets();
        $ticket->id_pago = $paymentId;
        $ticket->service = $service;
        $ticket->save();

        // Registro de servicios extra en la base de datos
        $service_extra = new Servicios_extra();
        $service_extra->id_ticket = $ticket->id;
        $service_extra->id_hora = ($request->servicio_extra == 1) ? $request->horario_se : 14;
        $service_extra->save();
    }

    public function getStripeKey()
    {
        return response()->json(['key' => env('STRIPE_KEY')]);
    }
}
