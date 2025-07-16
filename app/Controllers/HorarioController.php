<?php

namespace App\Controllers;

use App\Models\HorarioModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class HorarioController extends BaseController
{
    public function index()
{
    if (!session()->has('ficha_formacion')) {
        return redirect()->to('/login');
    }

    $ficha = session()->get('ficha_formacion');
    $horarioModel = new HorarioModel();
    $horario = $horarioModel->where('ficha_formacion', $ficha)->findAll();

    return view('aprendiz/dashboardAprendiz', ['horario' => $horario]);
}


    public function importar()
{
    helper(['form', 'filesystem']);
    $file = $this->request->getFile('archivo_excel');

    if ($file->isValid() && !$file->hasMoved()) {
        $spreadsheet = IOFactory::load($file->getTempName());
        $worksheet = $spreadsheet->getActiveSheet();
        $data = $worksheet->toArray();

        $horarioModel = new \App\Models\HorarioModel();
        $fichaUsuario = session()->get('ficha_formacion');

        if (!$fichaUsuario) {
            return redirect()->to('/horario')->with('error', 'Ficha de formación no encontrada en sesión.');
        }

        // Limpiar datos previos
        $horarioModel->where('ficha_formacion', $fichaUsuario)->delete();

        // Inicia desde la fila 4 (índice 3)
        for ($i = 3; $i < count($data); $i++) {
            $row = $data[$i];

            if (!isset($row[2]) || trim($row[2]) == '') continue;

            $fichaExcel = trim($row[2]);
            if ($fichaExcel != $fichaUsuario) continue;

            $aula       = trim($row[0] ?? '');
            $asignatura = trim($row[6] ?? '');
            $horaRango  = strtoupper(trim($row[8] ?? ''));

            // Validar formato de hora: "6 A 9"
            $partesHora = explode(' A ', $horaRango);
            if (count($partesHora) !== 2) continue;

            [$hora_inicio, $hora_fin] = $partesHora;

            // Recorre desde la columna J (índice 9) en adelante
            for ($col = 9; $col < count($row); $col++) {
                if (isset($row[$col]) && strtoupper(trim($row[$col])) === 'P') {
                    $dia = $this->obtenerDiaDesdeColumna($col);
                    if ($dia) {
                        $horarioModel->insert([
                            'ficha_formacion' => $fichaUsuario,
                            'dia'             => $dia,
                            'hora_inicio'     => $hora_inicio,
                            'hora_fin'        => $hora_fin,
                            'asignatura'      => $asignatura,
                            'aula'            => $aula
                        ]);
                    }
                }
            }
        }

        return redirect()->to('/horario')->with('success', 'Horario importado correctamente.');
    }

    return redirect()->to('/horario')->with('error', 'Error al subir el archivo.');
}


    private function obtenerDiaDesdeColumna($col)
{
    $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
    $indice = ($col - 9) % 5; // Suponiendo 5 columnas por semana (L-V)

    return $dias[$indice] ?? null;
}

}