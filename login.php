<!-- Standalone -->
<?php

include "conexion.php";
session_start();

if (isset($_POST['pLogin'])) {
    $oMysqli_stmt = $oMysqli->prepare("SELECT * FROM cliente WHERE correo = ?");    # Preparar declaración
    $oMysqli_stmt->bind_param("s", $_POST['pEmail']);                         # Atar parámetros/variables
    $oMysqli_stmt->execute();                                                              # Ejecutar consulta (query)
    $resultado = $oMysqli_stmt->get_result();                                              # Tomar resultado (query2)
    if ($fetch = $resultado->fetch_assoc()) {
        if (password_verify($_POST['pSecreto'], $fetch['contraseña'])) {
            // Guardar sesión
            $_SESSION['sesion'] = [$fetch['id_cliente'], $fetch['nombre']];
            header("Location: index.php");
        } else {
            header("Location: index.php?login_failed");
        }
    } else {
        header("Location: index.php?login_failed");
    }
}