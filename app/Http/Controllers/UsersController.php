<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;


class UsersController extends Controller
{
    public function users()
    {
        // Proporcionar datos de consulta a la vista de usuarios en el panel administrativo
        $usuario = Auth::user();
        $usuarios = User::all();
        return view('admin.usuarios', compact('usuarios', 'usuario'));
    }

    public function inicio()
    {
        // Retorno de datos de inicio de sesión
        $usuario = Auth::user();
        return view('inicio', compact('usuario'));
    }
    public function createUser(Request $request)
    {
        // Reglas de validación asignadas para la creación de usuarios
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|max:255|unique:users,email',
            'rol' => 'required|integer|in:1,2',
        ]);

        // Nomenclatura de asignación a la creación de usuarios
        $maxNumber = User::max('id') + 1;
        $username = 'CELH-' . $maxNumber;

        // Obtención de datos particulares para la creación de identificadores
        $data1 = substr($validated['name'], 0, 3);
        $data2 = strtoupper(substr($validated['apellido'], 0, 3));
        $data4 = substr($validated['correo'], 0, 3);
        $data3 = strlen($validated['correo']);
        $password = $data1 . $data2 . $data3 . $data4 . "#" . bin2hex(random_bytes(4));

        // Creación del usuario y registro en el sistema
        $user = new User();
        $user->rol = $validated['rol'];
        $user->name = $validated['name'];
        $user->apellido = $validated['apellido'];
        $user->email = $validated['correo'];
        $user->user = $username;
        $user->password = Hash::make(value: $password);
        $user->save();

        // Envío de información al correo electrónico del usuario
        Mail::to($request->correo)->send(new UserMail($username, $password));

        return redirect()->route('usuarios')->with('message', 'ok');
    }
    public function editUser(Request $request)
    {
        try {
            // Búsqueda y consulta de información del usuario a editar
            $user = User::findOrFail($request->id);
            $user->name = $request->name;
            $user->apellido = $request->apellido;
            $user->email = $request->correo;
            $user->rol = $request->rol;
            $user->save();

            return redirect()->route('usuarios')->with('message', 'update');
        } catch (\Exception $e) {
            return redirect()->route('usuarios')->withErrors(['error' => 'error' . $e->getMessage()]);
        }
    }
    public function deleteUser(Request $request, $id)
    {
        // Consulta del ID del usuario a eliminar
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('usuarios')->with('message', 'delete');
    }

    public function loginUser(Request $request)
    {
        // Validación de datos de entrada para el inicio de sesión
        $request->validate([
            'user' => 'required|string',
            'password' => 'required|string',
        ]);

        // Consulta de información del usuario
        $user = User::where('user', $request->user)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            // Acceso al sistema exitoso
            return redirect()->route('admin.inicio')->with('message', 'ok');
        }

        return redirect()->route('login')->with('message', 'error');
    }
    public function closeSession()
    {
        // Cerrar la sesión del usuario con acceso concedido
        Auth::logout();
        return redirect()->route('login');
    }
}
