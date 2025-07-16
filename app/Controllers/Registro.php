<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Registro extends BaseController
{
    public function index()
    {
        return view('paginas/registro_form');
    }

    public function guardar()
{
    $validation = \Config\Services::validation();

    $validation->setRules([
        'nombre_usuario'    => 'required|min_length[3]',
        'nombres'           => 'required|min_length[2]',
        'apellidos'         => 'required|min_length[2]',
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
        'nombres'        => $this->request->getPost('nombres'),
        'apellidos'      => $this->request->getPost('apellidos'),
        'correo'         => $this->request->getPost('correo'),
        'no_documento'   => $this->request->getPost('no_documento'),
        'pass_usuario'   => password_hash($this->request->getPost('pass_usuario'), PASSWORD_DEFAULT),
        'id_perfil'      => 1, // Rol aprendiz por defecto
        'estado'         => 1  // Activo por defecto (opcional)
    ]);

    return redirect()->to('/login')->with('mensajeSuccess', 'Usuario registrado correctamente');
}

}
