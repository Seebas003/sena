<?php 
namespace App\Controllers;
use App\Models\UsuarioModel;

class Usuarios extends BaseController
{
    public function listar()
    {
        $model = new UsuarioModel(); // Conexión automática aquí
        $data['usuarios'] = $model->findAll();
        return view('lista_usuarios', $data);
    }
}

?>