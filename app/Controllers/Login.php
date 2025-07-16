<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Login extends BaseController
{
    public function index()
    {
        return view('paginas/login'); // Vista del formulario de login
    }

    public function acceder()
    {
        $usuarioInput = $this->request->getPost('usuario');
        $passwordInput = $this->request->getPost('password');

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->where('nombre_usuario', $usuarioInput)->first();

        // Verificar si el usuario existe
        if (!$usuario) {
            return redirect()->back()->with('mensaje', 'Usuario no encontrado');
        }

        // Verificar si el usuario está activo
        if ((int)$usuario['estado'] !== 1) {
            return redirect()->back()->with('mensaje', 'Este usuario está inactivo. Contacte al administrador.');
        }

        // Verificar contraseña
        if (!password_verify($passwordInput, $usuario['pass_usuario'])) {
            return redirect()->back()->with('mensaje', 'Contraseña incorrecta');
        }

        // Guardar datos de sesión
        // Guardar datos de sesión comunes
session()->set([
    'id_usuario'     => $usuario['id_usuario'],
    'nombre_usuario' => $usuario['nombre_usuario'],
    'id_perfil'      => $usuario['id_perfil'],
    'correo'         => $usuario['correo'] ?? '',
    'logueado'       => true
]);
/*

// Si es Aprendiz, obtener ficha_formacion
if ((int)$usuario['id_perfil'] === 1) {
    $aprendizModel = new \App\Models\AprendizModel();
    $datosAprendiz = $aprendizModel->where('id_usuario', $usuario['id_usuario'])->first();


    if ($datosAprendiz) {
        session()->set([
            'ficha_formacion' => $datosAprendiz['ficha_formacion']
        ]);
    } else {
        return redirect()->back()->with('mensaje', 'No se encontró información del aprendiz.');
    }

    return redirect()->to('/dashboard/aprendiz');
}
*/
        switch ((int)$usuario['id_perfil']) {
            case 1:
                return redirect()->to('/dashboard/aprendiz'); // Aprendiz
            case 2:
                return redirect()->to('/dashboard'); // Administrador
            case 3:
                return redirect()->to('/dashboard/instructor');
            case 4:
                return redirect()->to('/dashboard/administrativo');
            default:
                return redirect()->to('/login')->with('mensaje', 'Perfil no válido');
        }
    }

    public function salir()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
