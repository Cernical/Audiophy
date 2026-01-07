<?php
session_start();
include "conexion.php";

// Guardar pista a escuchar
$_SESSION['pista'] = [
    'id'       => $_GET['id'],     # ID Canción
    'nombre' => $_GET['nombre'],   # Nombre artista
];

// Actualizar escuchas
$oMysqli_stmt = $oMysqli->prepare("UPDATE pista SET escuchas = escuchas + 1 WHERE id_pista = ?");  # Preparar declaración
$oMysqli_stmt->bind_param("i", $_GET['id']);                                                       # Atar parámetros/variables
$oMysqli_stmt->execute();                                                                          # Ejecutar consulta (query)

header("Location: player.php");