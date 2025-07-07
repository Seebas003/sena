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
        $nombre_usuario = $this->request->getPost('usuario');
        $clave_ingresada = $this->request->getPost('password');

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->where('nombre_usuario', $nombre_usuario)->first();

        if ($usuario) {
            // Verificamos si el usuario está activo
            if ($usuario['estado'] != 1) {
                return redirect()->back()->with('mensaje', 'Este usuario está inactivo. Contacte al administrador.');
            }

            // Verificamos la contraseña
            if (password_verify($clave_ingresada, $usuario['pass_usuario'])) {
                // Guardamos los datos de sesión
                session()->set([
                    'id_usuario'      => $usuario['id_usuario'],
                    'nombre_usuario'  => $usuario['nombre_usuario'],
                    'id_perfil'       => $usuario['id_perfil'],
                    'logueado'        => true
                ]);

                // Redirección según el perfil del usuario
                switch ($usuario['id_perfil']) {
                    case 1:
                        return redirect()->to('/dashboard/aprendiz');
                    case 2:
                        return redirect()->to('/dashboard');
                    case 3:
                        return redirect()->to('/dashboard/instructor');
                    case 4:
                        return redirect()->to('/dashboard/administrativo');
                    default:
                        return redirect()->to('/login')->with('mensaje', 'Perfil no válido');
                }
            } else {
                return redirect()->back()->with('mensaje', 'Contraseña incorrecta');
            }
        } else {
            return redirect()->back()->with('mensaje', 'Usuario no encontrado');
        }
    }

    public function salir()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
