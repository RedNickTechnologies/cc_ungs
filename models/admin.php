<?php
// models/admin.php

class Administrador {
    private $pdo;

    public function __construct($conexion) {
        $this->pdo = $conexion;
    }

    /**
     * Lista todos los talleres que están esperando aprobación[cite: 44].
     */
    public function obtenerTalleresPendientes() {
        $sql = "SELECT t.*, u.nombre as autor, u.email as contacto 
                FROM talleres t 
                JOIN usuarios u ON t.usuario_id = u.id 
                WHERE t.estado = 'pendiente'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Aprueba un taller para que sea visible en el mapa general[cite: 45].
     */
    public function aprobarTaller($idTaller) {
        $sql = "UPDATE talleres SET estado = 'aprobado' WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $idTaller]);
    }

    /**
     * Rechaza un taller especificando un motivo.
     */
    public function rechazarTaller($idTaller, $motivo) {
        $sql = "UPDATE talleres SET estado = 'rechazado', motivo_rechazo = :motivo WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $idTaller,
            ':motivo' => $motivo
        ]);
    }

    /**
     * Deshabilita a un miembro del portal en cualquier momento.
     */
    public function deshabilitarUsuario($idUsuario) {
        // Podríamos agregar un campo 'activo' en la tabla usuarios para esto
        $sql = "UPDATE usuarios SET activo = 0 WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $idUsuario]);
    }
}