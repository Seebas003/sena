<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuario';
    protected $primaryKey       = 'id_usuario';

    protected $allowedFields    = [
        'nombre_usuario',
        'correo',
        'no_documento',
        'pass_usuario',
        'id_perfil',
        'estado' // Esto es útil si manejas usuarios activos/inactivos
    ];

    protected $useTimestamps = false;
    protected $returnType    = 'array';

    // Puedes agregar métodos útiles para el panel
    public function obtenerUsuariosActivos()
    {
        return $this->where('estado', 'Activo')->findAll();
    }

    public function contarPorPerfil()
    {
        return $this->select('id_perfil, COUNT(*) as total')
                    ->groupBy('id_perfil')
                    ->findAll();
    }
}
