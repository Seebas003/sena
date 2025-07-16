<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use App\Models\AprendizModel;

class Dashboard extends BaseController
{
    // 👉 Panel administrador (perfil 2)
    public function index()
    {
        if (session()->get('id_perfil') != 2) {
            return redirect()->to('/login')->with('error', 'Acceso no autorizado');
        }

        $usuarioModel = new UsuarioModel();
        $usuarios = $usuarioModel->findAll();

        return view('admin/dashboard', ['usuarios' => $usuarios]);
    }

    // 👉 Panel aprendiz (perfil 1)
    public function aprendiz()
{
    if (session()->get('id_perfil') != 1) {
        return redirect()->to('/login')->with('error', 'Acceso no autorizado');
    }

    $usuarioModel = new UsuarioModel();
    $aprendizModel = new AprendizModel();

    $id_usuario = session()->get('id_usuario');
    $usuario = $usuarioModel->find($id_usuario);

    $aprendiz = $aprendizModel->where('id_usuario', $id_usuario)->first();

    // Si no hay aprendiz, lo inicializamos como array vacío
    if (!$aprendiz) {
        $aprendiz = [
            'ficha_formacion' => '',
            'programa_formacion' => ''
        ];
    }

    $aprendiz_completo = !empty($aprendiz['ficha_formacion']) && !empty($aprendiz['programa_formacion']);

    return view('aprendiz/dashboardAprendiz', [
        'usuario' => $usuario,
        'aprendiz' => $aprendiz,
        'aprendiz_completo' => $aprendiz_completo
    ]);
}


    // 👉 Panel instructor (perfil 3)
    public function instructor()
    {
        if (session()->get('id_perfil') != 3) {
            return redirect()->to('/login')->with('error', 'Acceso no autorizado');
        }

        return view('instructor/dashboardinstructor');
    }

    // 👉 Vista alternativa general (si tienes otra ruta /dashboard)
    public function dashboard()
    {
        $usuarioModel = new UsuarioModel();
        $usuarios = $usuarioModel->findAll();

        return view('paginas/dashboard', ['usuarios' => $usuarios]);
    }
}
