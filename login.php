<!-- Standalone -->
<?php

include "conexion.php";
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$vPaginaActual = $_SESSION['paginaActual'];

if (isset($_POST['pLogin'])) {
    $oMysqli_stmt = $oMysqli->prepare("SELECT * FROM cliente WHERE correo = ?");    # Preparar declaración
    $oMysqli_stmt->bind_param("s", $_POST['pEmail']);                         # Atar parámetros/variables
    $oMysqli_stmt->execute();                                                              # Ejecutar consulta (query)
    $resultado = $oMysqli_stmt->get_result();                                              # Tomar resultado (query2)
    if ($fetch = $resultado->fetch_assoc()) {
        if (password_verify($_POST['pSecreto'], $fetch['contraseña'])) {
            // Guardar sesión
            $_SESSION['sesion'] = [
                'id'       => $fetch['id_cliente'],
                'nombre' => $fetch['nombre'],
                'rol'     => 'usuario',
                'email'    => $fetch['correo'],
            ];
            header("Location: $vPaginaActual");
        } else {
            $_SESSION['login_failed'] = $_POST['pEmail'];
            header("Location: $vPaginaActual");
        }
    } else {
        $_SESSION['login_failed'] = $_POST['pEmail'];
        header("Location: $vPaginaActual");
    }
}