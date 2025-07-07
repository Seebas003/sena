<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Registro extends BaseController
{
    public function index()
    {
        return view('paginas/registro_form'); // asegúrate de que esta vista exista en views/paginas
    }

    public function guardar()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nombre_usuario'    => 'required|min_length[3]',
            'correo'            => 'required|valid_email|is_unique[usuario.correo]',
            'no_documento'      => 'required|numeric|is_unique[usuario.no_documento]',
            'pass_usuario'      => 'required|min_length[6]',
            'confirm-password'  => 'required|matches[pass_usuario]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $usuarioModel = new UsuarioModel();

        $usuarioModel->save([
            'nombre_usuario' => $this->request->getPost('nombre_usuario'),
            'correo'         => $this->request->getPost('correo'),
            'no_documento'   => $this->request->getPost('no_documento'),
            'pass_usuario'   => password_hash($this->request->getPost('pass_usuario'), PASSWORD_DEFAULT),
            'id_perfil'      => 1 // Por defecto: Aprendiz. Puedes cambiar esto según el rol que el admin asigne
        ]);

        return redirect()->to('/login')->with('mensaje', 'Usuario registrado correctamente');
    }
}
