<?php

namespace App\Models;
use CodeIgniter\Model;

class AprendizModel extends Model
{
    protected $table = 'aprendiz';
    protected $primaryKey = 'id_aprendiz';
    protected $allowedFields = ['id_usuario', 'ficha_formacion', 'programa_formacion'];
}

