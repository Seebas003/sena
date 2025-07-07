<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Login extends BaseController
{
    public function index()
    {
        return view('paginas/login');
    }

    public function acceder()
    {
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');

        $usuarioModel = new UsuarioModel();
        $datosUsuario = $usuarioModel->where('nombre_usuario', $usuario)->first();

        if ($datosUsuario && password_verify($password, $datosUsuario['pass_usuario'])) {
            $data = [
                'id_usuario' => $datosUsuario['id_usuario'],
                'nombre_usuario' => $datosUsuario['nombre_usuario'],
                'id_perfil' => $datosUsuario['id_perfil'],
                'logueado' => true
            ];
            session()->set($data);

switch ($datosUsuario['id_perfil']) {
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
            return redirect()->back()->with('mensaje', 'Credenciales incorrectas');
        }
    }

    public function salir()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
