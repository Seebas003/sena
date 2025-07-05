<?php
namespace App\Models;

use CodeIgniter\Model;

class UsuarioRegistroModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = ['nombre', 'correo', 'contrasena', 'tipo'];
    protected $useTimestamps = false;
}
?>