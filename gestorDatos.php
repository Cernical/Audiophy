<!-- Standalone -->
<?php

include "conexion.php";
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Tabla admin
if (isset($_POST['pAdmin'])) {
    $vHash = password_hash($_POST['pSecreto'], PASSWORD_DEFAULT);                                   # Default alg.
    $oMysqli_stmt = $oMysqli->prepare("INSERT INTO admin (correo, nombre, contraseña) VALUES (?,?,?)");    # Preparar declaración
    $oMysqli_stmt->bind_param("sss", $_POST['pEmail'], $_POST['pNombre'], $vHash);              # Atar parámetros/variables

    try {
        $oMysqli_stmt->execute();
        header("Location: panel-control.php?datos=admin&admin=1");
    } catch (Exception $e) {
        header("Location: panel-control.php?datos=admin&admin=0");
    }
}

// Tabla album
if (isset($_POST['pAlbum'])) {
    $oMysqli_stmt = $oMysqli->prepare("INSERT INTO album (id_artista, imagen, titulo, descripcion, genero, fecha, precio) VALUES (?,?,?,?,?,?,?)");    # Preparar declaración
    $oMysqli_stmt->bind_param("isssssi", $_POST['pArtista'], $_POST['pRuta'], $_POST['pTitulo'], $_POST['pDescripcion'], $_POST['pGenero'], $_POST['pFecha'], $_POST['pPrecio']);              # Atar parámetros/variables

    try {
        $oMysqli_stmt->execute();
        header("Location: panel-control.php?datos=album&album=1");
    } catch (Exception $e) {
        header("Location: panel-control.php?datos=album&album=0");
    }
}

// Tabla artista
if (isset($_POST['pArtista'])) {
    $oMysqli_stmt = $oMysqli->prepare("INSERT INTO artista (imagen, nombre, origen) VALUES (?,?,?)");    # Preparar declaración
    $oMysqli_stmt->bind_param("sss", $_POST['pRuta'], $_POST['pNombre'], $_POST['pOrigen']);              # Atar parámetros/variables

    try {
        $oMysqli_stmt->execute();
        header("Location: panel-control.php?datos=artista&artista=1");
    } catch (Exception $e) {
        header("Location: panel-control.php?datos=artista&artista=0");
    }
}

// Tabla cliente
if (isset($_POST['pCliente'])) {
    $vHash = password_hash($_POST['pSecreto'], PASSWORD_DEFAULT);                                   # Default alg.
    $oMysqli_stmt = $oMysqli->prepare("INSERT INTO cliente (correo, nombre, contraseña) VALUES (?,?,?)");    # Preparar declaración
    $oMysqli_stmt->bind_param("sss", $_POST['pEmail'], $_POST['pNombre'], $vHash);              # Atar parámetros/variables

    try {
        $oMysqli_stmt->execute();
        header("Location: panel-control.php?datos=cliente&cliente=1");
    } catch (Exception $e) {
        header("Location: panel-control.php?datos=cliente&cliente=0");
    }
}

// Tabla Pista
if (isset($_POST['pPista'])) {
    $oMysqli_stmt = $oMysqli->prepare("INSERT INTO pista (id_artista, id_album, audio, imagen, titulo, descripcion, genero, fecha, precio) VALUES (?,?,?,?,?,?,?,?,?)");    # Preparar declaración
    $oMysqli_stmt->bind_param("iissssssi", $_POST['pArtista'], $_POST['pAlbumes'], $_POST['pAudio'], $_POST['pRuta'], $_POST['pTitulo'], $_POST['pDescripcion'], $_POST['pGenero'], $_POST['pFecha'], $_POST['pPrecio']);              # Atar parámetros/variables

    try {
        $oMysqli_stmt->execute();
        header("Location: panel-control.php?datos=pista&pista=1");
    } catch (Exception $e) {
        header("Location: panel-control.php?datos=pista&pista=0");
    }
}
?>