<?php

namespace Tests\Feature;

use App\Mail\UserMail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

    public function test_usuario_es_creado_correctamente()
    {
        // Simula el envío de correos
        Mail::fake();

        // Datos de prueba
        $data = [
            'name' => 'Juan',
            'apellido' => 'Pérez',
            'correo' => 'juan@example.com',
            'rol' => 1,
        ];

        // Simula una petición POST a la ruta de creación de usuario
        $response = $this->post(route('usuarios.createUser'), $data);

        // Verifica que la respuesta sea una redirección
        $response->assertRedirect(route('usuarios'));
        $response->assertSessionHas('message', 'ok');

        // Verifica que el usuario se haya guardado en la base de datos
        $this->assertDatabaseHas('users', [
            'name' => 'Juan',
            'apellido' => 'Pérez',
            'email' => 'juan@example.com',
            'rol' => 1,
        ]);

        // Verifica que se haya enviado un correo al usuario
        Mail::assertSent(UserMail::class, function ($mail) use ($data) {
            return $mail->hasTo($data['correo']);
        });
    }
}
