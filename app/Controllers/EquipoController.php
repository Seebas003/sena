<?php

namespace App\Controllers;

use App\Models\EquipoModel;
use CodeIgniter\Controller;

class EquipoController extends BaseController
{
    public function index()
    {
        return view('equipos'); // Vista sin pasar todos los equipos
    }

   public function registrar()
{
    $model = new \App\Models\EquipoModel();

    $data = [
        'tipo_equipo'    => $this->request->getPost('tipo_equipo'),
        'marca_modelo'   => $this->request->getPost('marca_modelo'),
        'numero_serie'   => $this->request->getPost('numero_serie'),
        'estado'         => 1,
        'id_usuario'     => session()->get('id_usuario')
    ];

    if ($model->insert($data)) {
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Equipo registrado correctamente',
            'redirect' => base_url('/dashboard/aprendiz')
        ]);
    } else {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'No se pudo registrar el equipo'
        ]);
    }
}


    public function listar()
{
    $model = new \App\Models\EquipoModel();
    $idUsuario = session()->get('id_usuario');
    $equipos = $model->where('id_usuario', $idUsuario)->findAll();
    return $this->response->setJSON($equipos);
}

    public function eliminar($id)
{
    $equipoModel = new \App\Models\EquipoModel();

    if ($equipoModel->delete($id)) {
        return $this->response->setJSON(['success' => true]);
    } else {
        return $this->response->setJSON(['success' => false]);
    }
}

}
