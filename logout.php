<?php 
session_start();
$vPaginaActual = $_SESSION['paginaActual'];
unset($_SESSION['sesion']);
header("Location: $vPaginaActual");
?>