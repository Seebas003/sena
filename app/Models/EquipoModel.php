<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipoModel extends Model
{
    protected $table = 'equipo';
    protected $primaryKey = 'id_equipo';

    protected $allowedFields = [
        'tipo_equipo',
        'marca_modelo',
        'numero_serie',
        'estado',
        'id_usuario' // Asociado al usuario que registra el equipo
    ];
}
