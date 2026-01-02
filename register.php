<!-- Standalone -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "conexion.php";

if (isset($_POST['pRegistrar'])) {
    $vHash = password_hash($_POST['pSecreto'], PASSWORD_DEFAULT);                                   # Default alg.
    $oMysqli_stmt = $oMysqli->prepare("INSERT INTO cliente (correo, nombre, contraseña) VALUES (?,?,?)");    # Preparar declaración
    $oMysqli_stmt->bind_param("sss", $_POST['pEmail'], $_POST['pNombre'], $vHash);              # Atar parámetros/variables

    try {
        $oMysqli_stmt->execute();
        header("Location: index.php?registrado");
    } catch (Exception $e) {
        header("Location: index.php?register_duplicado");
    }
} else {
    header("Location: index.php");
}
?>