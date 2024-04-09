<?php
//Archivo de conexion ala base de datos

require_once 'SERVER.php';

try {
    $conexion = new PDO(SGBD, USER, PASSWORD);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->exec('SET CHARACTER SET utf8'); // Establecer juego de caracteres UTF-8
    return $conexion;
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}
