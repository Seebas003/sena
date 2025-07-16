<?php

namespace App\Models;

use CodeIgniter\Model;

class HorarioModel extends Model
{
    protected $table      = 'horario';
    protected $primaryKey = 'id_horario';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'ficha_formacion',
        'dia',
        'hora_inicio',
        'hora_fin',
        'asignatura',
        'aula'
    ];

    // Validaciones
    protected $validationRules = [
        'ficha_formacion' => 'required|numeric',
        'dia'             => 'required|in_list[Lunes,Martes,Miércoles,Jueves,Viernes]',
        'hora_inicio'     => 'required|regex_match[/^\d{2}:\d{2}$/]',
        'hora_fin'        => 'required|regex_match[/^\d{2}:\d{2}$/]',
        'asignatura'      => 'required|string|max_length[100]',
        'aula'            => 'required|string|max_length[50]',
    ];

    protected $validationMessages = [
        'ficha_formacion' => [
            'required' => 'La ficha es obligatoria.',
            'numeric'  => 'La ficha debe ser un número.',
        ],
        'dia' => [
            'required' => 'El día es obligatorio.',
            'in_list'  => 'El día debe ser válido.',
        ],
        'hora_inicio' => [
            'required'     => 'La hora de inicio es obligatoria.',
            'regex_match'  => 'Formato de hora inválido (debe ser HH:MM).',
        ],
        'hora_fin' => [
            'required'     => 'La hora de fin es obligatoria.',
            'regex_match'  => 'Formato de hora inválido (debe ser HH:MM).',
        ],
        'asignatura' => [
            'required'   => 'La asignatura es obligatoria.',
            'max_length' => 'La asignatura no puede superar los 100 caracteres.',
        ],
        'aula' => [
            'required'   => 'El aula es obligatoria.',
            'max_length' => 'El aula no puede superar los 50 caracteres.',
        ],
    ];

    protected $skipValidation = false;
}
