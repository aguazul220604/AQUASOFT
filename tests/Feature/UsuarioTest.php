<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UsuarioTest extends TestCase
{
    use RefreshDatabase; // Limpia la base de datos antes de cada prueba

    public function test_usuario_puede_registrarse()
    {
        $response = $this->post('/register', [
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(302); // Redirección tras el registro
        $this->assertDatabaseHas('users', ['email' => 'juan@example.com']);
    }
}
