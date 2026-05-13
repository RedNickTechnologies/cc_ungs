<?php
header('Content-Type: application/json');
require_once '../config/dbconexion.php'; 

try {
    $pdo->beginTransaction();

    // --- 1. CAPTURAR Y GUARDAR USUARIO ---
    $nombre = $_POST['name'] ?? '';
    $apellido = $_POST['surname'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['userPhoneNumber'] ?? '';
    
    // Capturamos la contraseña enviada por el usuario
    $passwordRaw = $_POST['userPassword'] ?? '';

    if (empty($passwordRaw)) {
        throw new Exception("La contraseña es obligatoria.");
    }

    // Hasheamos la contraseña real
    $passwordHashed = password_hash($passwordRaw, PASSWORD_DEFAULT); 

    $sqlUsuario = "INSERT INTO usuarios (rol, nombre, apellido, email, telefono_personal, password) 
                   VALUES ('colaborador', :nombre, :apellido, :email, :telefono, :password)";
    
    $stmtUsuario = $pdo->prepare($sqlUsuario);
    $stmtUsuario->execute([
        ':nombre' => $nombre,
        ':apellido' => $apellido,
        ':email' => $email,
        ':telefono' => $telefono,
        ':password' => $passwordHashed
    ]);

    $usuario_id = $pdo->lastInsertId(); 

    // --- 2. CAPTURAR Y GUARDAR TALLER ---
    // (Mantenemos la lógica de talleres que ya tenías)
    $nombreTaller = $_POST['workspaceName'] ?? '';
    $rubro = $_POST['rubro'] ?? '';
    $descripcion = $_POST['workspaceDescription'] ?? '';
    $tipoDireccion = $_POST['tipoDireccion'] ?? '';
    $direccion = ($tipoDireccion === 'Sede') ? $_POST['sedeSeleccionada'] : $_POST['direccionManual'];
    $lat = !empty($_POST['lat']) ? $_POST['lat'] : null;
    $lng = !empty($_POST['lng']) ? $_POST['lng'] : null;
    $diasAtencion = $_POST['diasAtencion'] ?? '';
    $horaInicio = $_POST['horaInicio'] ?? '';
    $horaFin = $_POST['horaFin'] ?? '';
    $telefonoTaller = !empty($_POST['tallerPhoneNumber']) ? $_POST['tallerPhoneNumber'] : null;
    $instagram = !empty($_POST['instagram']) ? $_POST['instagram'] : null;
    $facebook = !empty($_POST['facebook']) ? $_POST['facebook'] : null;

    $sqlTaller = "INSERT INTO talleres 
                  (usuario_id, nombre_taller, rubro, descripcion, tipo_direccion, direccion, latitud, longitud, dias_atencion, hora_inicio, hora_fin, telefono_taller, instagram, facebook, estado) 
                  VALUES 
                  (:usuario_id, :nombre_taller, :rubro, :descripcion, :tipo_direccion, :direccion, :latitud, :longitud, :dias_atencion, :hora_inicio, :hora_fin, :telefono_taller, :instagram, :facebook, 'pendiente')";

    $stmtTaller = $pdo->prepare($sqlTaller);
    $stmtTaller->execute([
        ':usuario_id' => $usuario_id,
        ':nombre_taller' => $nombreTaller,
        ':rubro' => $rubro,
        ':descripcion' => $descripcion,
        ':tipo_direccion' => $tipoDireccion,
        ':direccion' => $direccion,
        ':latitud' => $lat,
        ':longitud' => $lng,
        ':dias_atencion' => $diasAtencion,
        ':hora_inicio' => $horaInicio,
        ':hora_fin' => $horaFin,
        ':telefono_taller' => $telefonoTaller,
        ':instagram' => $instagram,
        ':facebook' => $facebook
    ]);

    $pdo->commit();
    echo json_encode(['exito' => true, 'mensaje' => '¡Registro exitoso! Ya podés iniciar sesión con tu email y contraseña.']);

} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    echo json_encode(['exito' => false, 'mensaje' => 'Error: ' . $e->getMessage()]);
}
?>