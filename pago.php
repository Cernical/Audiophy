<!-- Standalone -->
<?php

include "conexion.php";
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Guardar tarjeta
if (isset($_GET['guardar'])) {
    $oMysqli_stmt = $oMysqli->prepare("UPDATE cliente SET tarjeta = ? WHERE id_cliente = ?");       # Preparar declaración
    $oMysqli_stmt->bind_param("si", $_SESSION['sesion']['tarjeta'], $_SESSION['sesion']['id']);                        # Atar parámetros/variables
    $oMysqli_stmt->execute(); # Ejecutar consulta (query)
}

// Realizar pedido
$oMysqli_stmt = $oMysqli->prepare("INSERT INTO pedido (id_cliente, precio_total) VALUES (?,?)");    # Preparar declaración
$oMysqli_stmt->bind_param("sd", $_SESSION['sesion']['id'], $_SESSION['factura']);                   # Atar parámetros/variables
$oMysqli_stmt->execute();

// Conseguir ID del pedido
$oMysqli_stmt = $oMysqli->prepare("SELECT id_pedido FROM pedido ORDER BY id_pedido DESC LIMIT 1");  # Preparar declaración
$oMysqli_stmt->execute();                                                                           # Ejecutar consulta (query)
$resultado = $oMysqli_stmt->get_result();                                                           # Tomar resultado (query2)
$resultado = $resultado->fetch_assoc();

// Realizar lineas del pedido
$dCesta = $_SESSION['cesta'];
foreach ($dCesta as $key => $value) {
    $oMysqli_stmt = $oMysqli->prepare("INSERT INTO linea_pedido (id_pedido, id_pista, id_album, precio_individual) VALUES (?, ?, ?, ?)");    # Preparar declaración
    $oMysqli_stmt->bind_param("iiid", $resultado['id_pedido'], $value[0]['id'], $value[0]['id_album'], $value[0]['precio']);                 # Atar parámetros/variables
    $oMysqli_stmt->execute();
}

// Vaciar cesta y factura
unset($_SESSION['cesta']);
unset($_SESSION['factura']);

// Mover a biblioteca
header("Location: biblioteca.php?compra_realizada");
exit();