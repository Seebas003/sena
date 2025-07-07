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

    // ============================
    // 🔍 CONSULTAS DE USUARIOS
    // ============================

    // Obtener todos los usuarios (activos e inactivos)
    public function obtenerTodos()
    {
        return $this->findAll();
    }

    // Obtener solo usuarios activos
    public function obtenerUsuariosActivos()
    {
        return $this->where('estado', 1)->findAll();
    }

    // Obtener usuario por ID
    public function obtenerPorId($id)
    {
        return $this->find($id);
    }

    // Obtener usuario por nombre (útil para login)
    public function obtenerPorNombre($nombre_usuario)
    {
        return $this->where('nombre_usuario', $nombre_usuario)->first();
    }

    // Obtener usuarios por perfil (opcional)
    public function obtenerPorPerfil($id_perfil)
    {
        return $this->where('id_perfil', $id_perfil)->findAll();
    }

    // Obtener cantidad de usuarios por perfil
    public function contarPorPerfil()
    {
        return $this->select('id_perfil, COUNT(*) as total')
                    ->groupBy('id_perfil')
                    ->findAll();
    }

    // ============================
    // ✏️ INSERCIÓN Y EDICIÓN
    // ============================

    // Insertar nuevo usuario
    public function crearUsuario($data)
    {
        return $this->insert($data);
    }

    // Actualizar usuario (general)
    public function actualizarUsuario($id, $data)
    {
        return $this->update($id, $data);
    }

    // ============================
    // 🚫 ACTIVAR / DESACTIVAR
    // ============================

    // Marcar usuario como inactivo
    public function desactivarUsuario($id)
    {
        return $this->update($id, ['estado' => 0]);
    }

    // Marcar usuario como activo
    public function activarUsuario($id)
    {
        return $this->update($id, ['estado' => 1]);
    }
}
