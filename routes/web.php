<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AjustesController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\NovedadesController;


///////////////////////////////////////////////////////////// CLIENTE

// Vista: INICIO
Route::get('/', function () {
    return view('client.inicio');
})->name(name: 'inicio');

// Vista: NOVEDADES
Route::get('/novedades', [ClienteController::class, 'novedades'])->name(name: 'novedades');

// Vista: SERVICIOS
Route::get('/servicios', function () {
    return view('client.servicios');
})->name(name: 'servicios');

// Vista: HOSPEDAJE
Route::get('/hospedaje', function () {
    return view('client.hospedaje');
})->name(name: 'hospedaje');

// Vista: FORMULARIO DE PAGO DE TICKETS
Route::get('/pagos/formulario', [PaymentController::class, 'formulario'])->name('pagos.formulario');

// Procesamiento de pago de tickets
Route::post('/pagos/process-payment', [PaymentController::class, 'processPayment'])->name('pagos.processPayment');

///////////////////////////////////////////////////////////// ADMINISTRADOR

//////////////////////////////////////// Tickets
// Vista administrador
Route::get('/tickets', [AdminController::class, 'tickets'])->name('admin.tickets')->middleware('auth');
// Lectura de QRs (tickets)
Route::post('/procesar-ticket', [TicketController::class, 'procesarTicket'])->name('procesarTicket');

//////////////////////////////////////// Payments
// Vista administrador
Route::get('/payments', [AdminController::class, 'payments'])->name('admin.payments')->middleware('auth');
Route::get('/stripe-key', [PaymentController::class, 'getStripeKey']);

//////////////////////////////////////// Reservaciones
// Vista administrador
Route::get('/reservaciones', [AdminController::class, 'reservations'])->name('admin.reservaciones')->middleware('auth');
// Lectura de QRs (reservaciones)
Route::post('/procesar-cabin', [TicketController::class, 'procesarCabin'])->name('procesarCabin');

//////////////////////////////////////// Estadisticas
// Vista administrador
Route::get('/estadisticas', [AdminController::class, 'statistics'])->name('admin.estadisticas')->middleware('auth');

//////////////////////////////////////// Novedades
// Vista administrador
Route::get('/novedades/admin', [NovedadesController::class, 'novedades'])->name('admin.novedades')->middleware('auth');
// Crear nuevo registro
Route::post('/novedades/create', [NovedadesController::class, 'createNovedades'])->name('noticias.createNovedades');
// Editar registro existente
Route::post('/novedades/edit', [NovedadesController::class, 'editNovedades'])->name('noticias.editNovedades');
// Eliminar registro existente
Route::delete('/novedades/{id}', [NovedadesController::class, 'deleteNovedades'])->name('noticias.deleteNovedades');

//////////////////////////////////////// Ajustes
// Vista administrador
Route::get('/ajustes', [AjustesController::class, 'settings'])->name('admin.ajustes')->middleware('auth');
// Actualizar precio de entradas
Route::post('/ajustes/update1/{id}', [AjustesController::class, 'updateEntradas'])->name('ajustes.updateEntradas');
// Actualizar precio de cabañas
Route::post('/ajustes/update2/{id}', [AjustesController::class, 'updateCabins'])->name('ajustes.updateCabins');
// Actualizar precio de servicios
Route::post('/ajustes/update3/{id}', [AjustesController::class, 'updateServicios'])->name('ajustes.updateServicios');
// Actualizar datos de descuentos
Route::post('/ajustes/update4/', [AjustesController::class, 'updateDescuentos'])->name('ajustes.updateDescuentos');

//////////////////////////////////////// Usuarios
// Vista administrador
Route::get('/usuarios', [UsersController::class, 'users'])->name('usuarios')->middleware('auth');
// Crear un nuevo usuario
Route::post('/usuarios/create', [UsersController::class, 'createUser'])->name('usuarios.createUser');
// Editar usuario existente
Route::post('/usuarios/edit', [UsersController::class, 'editUser'])->name('usuarios.editUser');
// Eliminar usuario existente
Route::delete('/usuarios/{id}', [UsersController::class, 'deleteUser'])->name('usuarios.deleteUser');


//////////////////////////////////////// Login
// Vista de login
Route::get('/login', function () {
    return view('login');
})->name(name: 'login');
// Procesamiento de petición de acceso
Route::post('/usuarios/inicio', [UsersController::class, 'loginUser'])->name('usuarios.loginUser');
// Aterrizaje de autenticación
Route::get('/inicio', [UsersController::class, 'inicio'])->name('admin.inicio')->middleware('auth');
// Cerrar sesión del usuario
Route::post('/logout', [UsersController::class, 'closeSession'])->name('logout');


