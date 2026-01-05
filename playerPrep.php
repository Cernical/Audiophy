<?php
session_start();

$_SESSION['pista'] = [
    'id'       => $_GET['id'],     # ID Canción
    'nombre' => $_GET['nombre'],   # Nombre artista
];

header("Location: player.php");