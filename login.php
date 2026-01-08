<!-- Standalone -->
<?php

include "conexion.php";
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$vPaginaActual = $_SESSION['paginaActual'];

if (isset($_POST['pLogin']) or (isset($_POST['pLoginAdmin']))) {
    if (isset($_POST['pLogin'])) {
        $tabla = "cliente";
    }
    if (isset($_POST['pLoginAdmin'])) {
        $tabla = "admin";
    }
    $oMysqli_stmt = $oMysqli->prepare("SELECT * FROM $tabla WHERE correo = ?");           # Preparar declaración
    $oMysqli_stmt->bind_param("s", $_POST['pEmail']);                                      # Atar parámetros/variables
    $oMysqli_stmt->execute();                                                              # Ejecutar consulta (query)
    $resultado = $oMysqli_stmt->get_result();                                              # Tomar resultado (query2)
    if ($fetch = $resultado->fetch_assoc()) {
        if (password_verify($_POST['pSecreto'], $fetch['contraseña'])) {
            // Guardar sesión
            if (isset($_POST['pLogin'])) {
                $vColumnaId = "id_cliente";
                $vRol = "usuario";
            }
            if (isset($_POST['pLoginAdmin'])) {
                $vColumnaId = "id_admin";
                $vRol = "superuser";
            }
            $_SESSION['sesion'] = [
                'id'       => $fetch[$vColumnaId],
                'nombre' => $fetch['nombre'],
                'rol'     => $vRol,
                'email'    => $fetch['correo'],
            ];
            if (isset($_POST['pLoginAdmin'])) {
                header("Location: panel-control.php");
            } else {
                header("Location: $vPaginaActual");
            }
        } else {
            $_SESSION['login_failed'] = $_POST['pEmail'];
            header("Location: $vPaginaActual");
        }
    } else {
        $_SESSION['login_failed'] = $_POST['pEmail'];
        header("Location: $vPaginaActual");
    }
}