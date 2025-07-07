<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class Usuario extends BaseController
{
    // Muestra el dashboard con la tabla de usuarios
    public function index()
    {
        $usuarioModel = new UsuarioModel();
        $data['usuarios'] = $usuarioModel->findAll();

        return view('admin/dashboard', $data);
    }

    // Muestra el formulario para agregar un nuevo usuario
    public function nuevo()
    {
        return view('usuarios/nuevo');
    }

    // Procesa y guarda un nuevo usuario
    public function agregar()
    {
        $usuarioModel = new UsuarioModel();

        // Encriptar contraseña
        $clavePlano = $this->request->getPost('clave');
        $claveEncriptada = password_hash($clavePlano, PASSWORD_DEFAULT);

        $data = [
            'nombre_usuario' => $this->request->getPost('nombre'),
            'correo'         => $this->request->getPost('correo'),
            'no_documento'   => $this->request->getPost('documento'),
            'pass_usuario'   => $claveEncriptada,
            'id_perfil'      => $this->request->getPost('perfil'),
            'estado'         => 1 // Activo por defecto
        ];

        $usuarioModel->insert($data);

        return redirect()->to('/usuario')->with('success', 'Usuario agregado exitosamente.');
    }

    // Muestra el formulario para editar un usuario existente
    public function editar($id)
    {
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($id);

        if (!$usuario) {
            return redirect()->to('/usuario')->with('error', 'Usuario no encontrado.');
        }

        $data['usuario'] = $usuario;
        return view('usuarios/editar', $data);
    }

    // Procesa la actualización de un usuario
    public function actualizar()
    {
        $usuarioModel = new UsuarioModel();
        $id = $this->request->getPost('id');

        if (!$id) {
            return redirect()->to('/usuario')->with('error', 'ID de usuario no recibido.');
        }

        $data = [
            'nombre_usuario' => $this->request->getPost('nombre'),
            'correo'         => $this->request->getPost('correo'),
            'no_documento'   => $this->request->getPost('documento'),
            'id_perfil'      => $this->request->getPost('perfil')
        ];

        // Si se envió una nueva contraseña, la encriptamos
        $clave = $this->request->getPost('clave');
        if (!empty($clave)) {
            $data['pass_usuario'] = password_hash($clave, PASSWORD_DEFAULT);
        }

        $usuarioModel->update($id, $data);

        return redirect()->to('/usuario')->with('success', 'Usuario actualizado correctamente.');
    }

    // Desactiva un usuario (estado = 0)
    public function desactivar($id)
    {
        $usuarioModel = new UsuarioModel();

        if ($usuarioModel->find($id)) {
            $usuarioModel->update($id, ['estado' => 0]);
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Usuario no encontrado']);
    }

    // Activa un usuario (estado = 1)
    public function activar($id)
{
    $usuarioModel = new \App\Models\UsuarioModel();

    if ($usuarioModel->find($id)) {
        $usuarioModel->update($id, ['estado' => 1]);
        return $this->response->setJSON(['success' => true]);
    }

    return $this->response->setJSON(['success' => false, 'message' => 'Usuario no encontrado']);
}
}
