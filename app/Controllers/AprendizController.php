<?php

namespace App\Controllers;

use App\Models\AprendizModel;
use App\Models\UsuarioModel;

class AprendizController extends BaseController
{
    public function formulario()
    {
        $usuarioModel = new UsuarioModel();
        $aprendizModel = new AprendizModel();

        $idUsuario = session()->get('id_usuario');

        $usuario = $usuarioModel->find($idUsuario);
        $aprendiz = $aprendizModel->where('id_usuario', $idUsuario)->first();

        return view('/formulario_aprendiz', [
            'usuario' => $usuario,
            'aprendiz' => $aprendiz
        ]);
    }

    public function guardar()
{
    $model = new AprendizModel();
    $idUsuario = session()->get('id_usuario');

    // Verificamos si ya existe un aprendiz con ese id_usuario
    $existente = $model->where('id_usuario', $idUsuario)->first();

    $data = [
        'ficha_formacion'    => $this->request->getPost('ficha_formacion'),
        'programa_formacion' => $this->request->getPost('programa_formacion'),
    ];

    if ($existente) {
        // Actualizar
        $model->update($existente['id_aprendiz'], $data);
    } else {
        // Insertar
        $data['id_usuario'] = $idUsuario;
        $model->insert($data);
    }

    return redirect()->to('/dashboard/aprendiz')->with('success', 'Datos guardados correctamente.');
}



}
