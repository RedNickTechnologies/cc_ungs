<?php
// models/user.php

class Usuario {
    private $pdo;

    public function __construct($conexion) {
        $this->pdo = $conexion;
    }

    /**
     * Registra un nuevo colaborador en el sistema.
     * Cumple con el requerimiento de inscripción (Nombre, Teléfono, Correo)[cite: 37].
     */
    public function registrar($nombre, $apellido, $email, $telefono, $password) {
        try {
            $sql = "INSERT INTO usuarios (rol, nombre, apellido, email, telefono_personal, password) 
                    VALUES ('colaborador', :nombre, :apellido, :email, :telefono, :password)";
            
            $stmt = $this->pdo->prepare($sql);
            
            // Seguridad: Encriptamos la contraseña antes de guardarla [cite: 23]
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            return $stmt->execute([
                ':nombre'    => $nombre,
                ':apellido'  => $apellido,
                ':email'     => $email,
                ':telefono'  => $telefono,
                ':password'  => $passwordHash
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Valida las credenciales para el login[cite: 23].
     */
    public function login($email, $password) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario; // Retorna los datos del usuario si la clave es correcta
        }
        return false;
    }
}