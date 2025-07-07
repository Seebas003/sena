<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = [
        'nombre_usuario',
        'correo',
        'no_documento',
        'pass_usuario',
        'id_perfil',
        'estado'
    ];

    protected $useTimestamps = false;
    protected $returnType    = 'array';

    // ✅ Obtener usuarios junto con el nombre del perfil (JOIN)
    public function obtenerUsuariosConPerfil()
    {
        return $this->select('usuario.*, perfil.nombre_perfil')
                    ->join('perfil', 'perfil.id_perfil = usuario.id_perfil', 'left')
                    ->findAll();
    }

    // 🔍 CONSULTAS

    // Todos los usuarios
    public function obtenerTodos()
    {
        return $this->findAll();
    }

    // Solo usuarios activos
    public function obtenerUsuariosActivos()
    {
        return $this->where('estado', 1)->findAll();
    }

    // Usuario por ID
    public function obtenerPorId($id)
    {
        return $this->find($id);
    }

    // Usuario por nombre (para login)
    public function obtenerPorNombre($nombre_usuario)
    {
        return $this->where('nombre_usuario', $nombre_usuario)->first();
    }

    // Usuarios por perfil
    public function obtenerPorPerfil($id_perfil)
    {
        return $this->where('id_perfil', $id_perfil)->findAll();
    }

    // ✏️ INSERCIÓN Y EDICIÓN

    public function crearUsuario($data)
    {
        return $this->insert($data);
    }

    public function actualizarUsuario($id, $data)
    {
        return $this->update($id, $data);
    }

    // 🚫 Activar / Desactivar

    public function desactivarUsuario($id)
    {
        return $this->update($id, ['estado' => 0]);
    }

    public function activarUsuario($id)
    {
        return $this->update($id, ['estado' => 1]);
    }
}
