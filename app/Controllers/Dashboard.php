<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $usuarioModel = new UsuarioModel();
        $usuarios = $usuarioModel->findAll(); 
        if (session()->get('id_perfil') != 2) {
            return redirect()->to('/login')->with('error', 'Acceso no autorizado');
        }

        return view('admin/dashboard', ['usuarios' => $usuarios]);
    }
    public function aprendiz()
    {
        if (session()->get('id_perfil') != 1) {
            return redirect()->to('/login')->with('error', 'Acceso no autorizado');
        }

        return view('aprendiz/dashboardAprendiz');
    }
    public function instructor()
    {
        if (session()->get('id_perfil') != 3) {
            return redirect()->to('/login')->with('error', 'Acceso no autorizado');
        }
        return view('instructor/dashboardinstructor');
    }

}
