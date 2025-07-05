<?php

namespace App\Controllers;

use App\Models\UsuarioRegistroModel;

class Registro extends BaseController
{
    public function index()
    {
        return view('paginas/registro_form');
    }

    public function guardar()
    {
        $validacion = \Config\Services::validation();

        $validacion->setRules([
            'nombre' => 'required',
            'correo' => 'required|valid_email|is_unique[usuario.correo]',
            'contrasena' => 'required|min_length[6]',
            'confirm-password' => 'matches[contrasena]'
        ]);

        if (!$validacion->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validacion->getErrors());
        }

        $model = new UsuarioRegistroModel();

        $model->insert([
            'nombre'     => $this->request->getPost('nombre'),
            'correo'     => $this->request->getPost('correo'),
            'contrasena' => password_hash($this->request->getPost('contrasena'), PASSWORD_DEFAULT),
            'tipo'       => 'aprendiz'
        ]);

        return redirect()->to('/Registro/exito');
    }

    public function exito()
    {
        return view('registro_exito');
    }
}
?>