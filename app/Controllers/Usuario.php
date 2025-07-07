<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class Usuario extends BaseController
{
    // ✅ Muestra el dashboard con los usuarios + nombre_perfil
    public function index()
{
    $db = \Config\Database::connect();

    $query = $db->table('usuario u')
        ->select('u.*, p.nombre_perfil')
        ->join('perfil p', 'u.id_perfil = p.id_perfil')
        ->get();

    $data['usuarios'] = $query->getResultArray();

    return view('admin/dashboard', $data);
}

    // ✅ Muestra el formulario para agregar un nuevo usuario
    public function nuevo()
    {
        return view('usuarios/nuevo');
    }

    // ✅ Procesa y guarda un nuevo usuario
    public function agregar()
    {
        $usuarioModel = new UsuarioModel();

        $clavePlano = $this->request->getPost('clave');
        $claveEncriptada = password_hash($clavePlano, PASSWORD_DEFAULT);

        $data = [
            'nombre_usuario' => $this->request->getPost('nombre'),
            'correo'         => $this->request->getPost('correo'),
            'no_documento'   => $this->request->getPost('documento'),
            'pass_usuario'   => $claveEncriptada,
            'id_perfil'      => $this->request->getPost('perfil'),
            'estado'         => 1
        ];

        $usuarioModel->insert($data);
        return redirect()->to('/usuario')->with('success', 'Usuario agregado exitosamente.');
    }

    // ✅ Muestra el formulario de edición
    public function editar($id)
    {
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($id);

        if (!$usuario) {
            return redirect()->to('/usuario')->with('error', 'Usuario no encontrado.');
        }

        $data['usuario'] = $usuario;
        return view('usuarios/editar', $data);
    }

    // ✅ Procesa la actualización del usuario
    // app/Controllers/Usuario.php

public function actualizar()
{
    $usuarioModel = new UsuarioModel();
    $id = $this->request->getPost('id');

    if (!$id) {
        return redirect()->to('/usuario')->with('error', 'ID de usuario no recibido.');
    }

    // Datos base
    $data = [
        'nombre_usuario' => $this->request->getPost('nombre'),
        'correo'         => $this->request->getPost('correo'),
        'no_documento'   => $this->request->getPost('documento'),
        'id_perfil'      => $this->request->getPost('perfil')
    ];

    // Verificar si hay una nueva contraseña
    $clave = $this->request->getPost('clave');
    if (!empty($clave)) {
        $data['pass_usuario'] = password_hash($clave, PASSWORD_DEFAULT);
    }

    $usuarioModel->update($id, $data);

    return redirect()->to('/usuario')->with('success', 'Usuario actualizado correctamente.');
}


    // ✅ Desactiva un usuario
    public function desactivar($id)
    {
        $usuarioModel = new UsuarioModel();
        if ($usuarioModel->find($id)) {
            $usuarioModel->update($id, ['estado' => 0]);
            return $this->response->setJSON(['success' => true]);
        }
        return $this->response->setJSON(['success' => false, 'message' => 'Usuario no encontrado']);
    }

    // ✅ Activa un usuario
    public function activar($id)
    {
        $usuarioModel = new UsuarioModel();
        if ($usuarioModel->find($id)) {
            $usuarioModel->update($id, ['estado' => 1]);
            return $this->response->setJSON(['success' => true]);
        }
        return $this->response->setJSON(['success' => false, 'message' => 'Usuario no encontrado']);
    }
   public function exportarExcel()
{
    $usuarioModel = new \App\Models\UsuarioModel();
    $usuarios = $usuarioModel->obtenerUsuariosConPerfil();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Usuarios SENA');

    // Encabezados
    $headers = ['Nombre', 'Correo', 'Documento', 'Perfil', 'Estado'];
    $columnas = ['A', 'B', 'C', 'D', 'E'];

    foreach ($headers as $i => $header) {
        $sheet->setCellValue($columnas[$i] . '1', $header);
    }

    // Estilo de encabezado
    $headerStyle = [
        'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 12],
        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '28a745']],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
    ];
    $sheet->getStyle('A1:E1')->applyFromArray($headerStyle);

    // Contenido de datos
    $fila = 2;
    foreach ($usuarios as $usuario) {
        $estadoTexto = $usuario['estado'] == 1 ? 'Activo' : 'Inactivo';

        $sheet->setCellValue("A$fila", $usuario['nombre_usuario']);
        $sheet->setCellValue("B$fila", $usuario['correo']);
        $sheet->setCellValue("C$fila", $usuario['no_documento']);
        $sheet->setCellValue("D$fila", $usuario['nombre_perfil']);
        $sheet->setCellValue("E$fila", $estadoTexto);

        $fila++;
    }

    // Estilo para datos
    $dataRange = "A2:E" . ($fila - 1);
    $sheet->getStyle($dataRange)->applyFromArray([
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
    ]);

    // Autoajustar columnas
    foreach ($columnas as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Generar el archivo
    $writer = new Xlsx($spreadsheet);
    $filename = 'usuarios_' . date('Ymd_His') . '.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $writer->save('php://output');
    exit;
}
}
