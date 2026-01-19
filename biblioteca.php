<!-- Standalone -->

<?php
session_start();
$_SESSION['paginaActual'] = "biblioteca.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Al pulsar siguiente o atras
if (isset($_GET['siguiente'])) {
    if ($_SESSION['pagina'] < $_SESSION['techoPaginas']) {
        $_SESSION['offset'] = $_SESSION['offset'] + $_SESSION['offsetSumador'];
        $_SESSION['pagina'] = $_SESSION['pagina'] + 1;
    }
}
if (isset($_GET['atras'])) {
    if ($_SESSION['pagina'] > 1) {
        $_SESSION['offset'] = $_SESSION['offset'] - $_SESSION['offsetSumador'];
        $_SESSION['pagina'] = $_SESSION['pagina'] - 1;
    }
}

// Gestión géneros
if (isset($_GET['genero']) and (isset($_SESSION['genero']))) {
    if ($_SESSION['genero'] != $_GET['genero']) {       # Si se cambia de género
        $_SESSION['bReiniciarConfiguracion'] = True;
        $_SESSION['genero'] = $_GET['genero'];          # Si se mantiene
    } else {
        $_SESSION['bReiniciarConfiguracion'] = False;
    }
}
if (isset($_GET['genero']) and (!isset($_SESSION['genero']))) {
    // Primera vez
    $_SESSION['genero'] = $_GET['genero'];
    $_SESSION['bReiniciarConfiguracion'] = True;
}

include "conexion.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Favicons generados por realfavicongenerator.net -->
    <link rel="icon" type="image/png" href="./media/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="./media/favicon.svg" />
    <link rel="shortcut icon" href="./media/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="./media/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Audiophy" />
    <link rel="manifest" href="./media/site.webmanifest" />
    <!----------------------------------------------------->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Audiophy: Redescubre la música</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Estilos para colores y ajustes refinados */
        body {
            background-color: #0f0f14;
            color: #eaeaf0;
        }

        .navbar {
            background-color: #15151d;
            min-height: 100px;
            padding-top: 0rem;
            padding-bottom: 0rem;
        }

        .hero {
            background: linear-gradient(135deg, #1c1c2b, #0f0f14);
            padding: 20rem 1rem;
        }

        #hero1 {
            background-image: url('./media/background-02-es.jpg');
            background-size: cover;
            background-position: top;
            background-repeat: no-repeat;
        }

        #hero2 {
            background-image: url('./media/background-04-es.jpg.webp');
            background-size: cover;
            background-position: top;
            background-repeat: no-repeat;
        }

        #hero3 {
            background-image: url('./media/background-01.jpg.webp');
            background-size: cover;
            background-position: top;
            background-repeat: no-repeat;
        }

        .album-card {
            background-color: #181825;
            border: none;
            transition: transform 0.2s ease;
        }

        .album-card:hover {
            transform: scale(1.03);
        }

        .album-cover {
            height: 180px;
            background-size: cover;
            background-position: center;
            border-radius: .5rem .5rem 0 0;
        }

        .login-card {
            background-color: #181825;
            border: none;
            width: 100%;
            max-width: 420px;
        }

        .album-card-link {
            text-decoration: none;
        }

        footer {
            background-color: #15151d;
        }
    </style>
</head>

<header>
    <!-- Módulo navbar -->
    <?php include "navbar.php"; ?>
</header>

<body>
    <?php
    if (isset($_GET['compra_realizada'])) {
        ?>
        <div class="alert alert-success mt-3" role="alert">
            Compra realizada, ¡Muchas gracias!.
        </div>
        <?php
    }
    ?>

    <div class="container d-flex justify-content-center align-items-center gap-3 mt-3">
        <?php
        $oMysqli_stmt = $oMysqli->prepare("SELECT DISTINCT(genero) FROM pista;");      # Preparar declaración
        $oMysqli_stmt->execute();                                                       # Ejecutar consulta (query)
        $resultado = $oMysqli_stmt->get_result();

        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                if (isset($_GET['genero'])) {
                    if ($_GET['genero'] == $row['genero']) {
                        ?>
                        <a href="biblioteca.php?genero=<?php echo $row['genero'] ?>"><button class="btn btn-light fw-bold" style="width: 100px;"><?php echo $row['genero'] ?></button></a>
                        <?php
                    } else {
                        ?>
                        <a href="biblioteca.php?genero=<?php echo $row['genero'] ?>"><button class="btn btn-dark fw-bold" style="width: 100px;"><?php echo $row['genero'] ?></button></a>
                        <?php
                    }
                } else {
                    ?>
                    <a href="biblioteca.php?genero=<?php echo $row['genero'] ?>"><button class="btn btn-dark fw-bold" style="width: 100px;"><?php echo $row['genero'] ?></button></a>
                    <?php
                }
            }
        }
        ?>
        <a href="biblioteca.php?genero=todos"><button class="btn btn-dark fw-bold" style="width: 100px;">Todos</button></a>
    </div>

    <div class="container">
        <?php
        // Comprobar cantidad total de pistas
        if (!isset($_SESSION['techoPaginas']) or (isset($_SESSION['bReiniciarConfiguracion']))) {
            if (isset($_GET['genero'])) {
                if ($_GET['genero'] == "todos") {
                    $oMysqli_stmt = $oMysqli->prepare("SELECT * FROM pista WHERE id_pista IN (SELECT id_pista FROM pedido, linea_pedido WHERE pedido.id_pedido = linea_pedido.id_pedido AND pedido.id_cliente = ?)"); 
                    $oMysqli_stmt->bind_param("i", $_SESSION['sesion']['id']);
                } else {
                    $oMysqli_stmt = $oMysqli->prepare("SELECT * FROM pista WHERE genero LIKE ? AND id_pista IN (SELECT id_pista FROM pedido, linea_pedido WHERE pedido.id_pedido = linea_pedido.id_pedido AND pedido.id_cliente = ?)");      # Preparar declaración
                    $oMysqli_stmt->bind_param("si", $_GET['genero'], $_SESSION['sesion']['id']);                                   # Atar parámetros/variables
                }
            } else {
                $oMysqli_stmt = $oMysqli->prepare("SELECT * FROM pista WHERE id_pista IN (SELECT id_pista FROM pedido, linea_pedido WHERE pedido.id_pedido = linea_pedido.id_pedido AND pedido.id_cliente = ?)"); 
                $oMysqli_stmt->bind_param("i", $_SESSION['sesion']['id']);
            }
            $oMysqli_stmt->execute();                                          # Ejecutar consulta (query)
            $resultado = $oMysqli_stmt->get_result();
            $vNumPistas = $resultado->num_rows;
        }
        
        // Configuración slider dinámico
        if (!isset($_SESSION['pagina']) or (isset($_SESSION['bReiniciarConfiguracion']))) {
            $_SESSION['pagina'] = 1;    # Por defecto página 1
        }
        if (!isset($_SESSION['offset']) or (isset($_SESSION['bReiniciarConfiguracion']))) {
            $_SESSION['offset'] = 0;    # Por defecto offset 0
        }

        $vNumeroTarjetas = 12;   # Número tarjetas por pagina

        if (!isset($_SESSION['offsetSumador']) or (isset($_SESSION['bReiniciarConfiguracion']))) {
            $_SESSION['offsetSumador'] = $vNumeroTarjetas;    # Por defecto offset 0
        }

        // Calcular paginación techo(Número de pistas / número tarjetas por página)
        if (!isset($_SESSION['techoPaginas']) or (isset($_SESSION['bReiniciarConfiguracion']))) {
            $_SESSION['techoPaginas'] = ceil($vNumPistas / $vNumeroTarjetas);
        }

        // Consulta pistas (Por defecto)
        $oMysqli_stmt = $oMysqli->prepare("SELECT * FROM pista WHERE id_pista IN (SELECT id_pista FROM pedido, linea_pedido WHERE pedido.id_pedido = linea_pedido.id_pedido AND pedido.id_cliente = ?) ORDER BY id_pista desc LIMIT ? OFFSET ?");       # Preparar declaración
        $oMysqli_stmt->bind_param("iii", $_SESSION['sesion']['id'], $vNumeroTarjetas, $_SESSION['offset']);                                 # Preparar declaración

        # En caso de ser un género
        if (isset($_GET['genero']) and ($_GET['genero'] != "todos")) {
            $oMysqli_stmt = $oMysqli->prepare("SELECT * FROM pista WHERE genero LIKE ? AND id_pista IN (SELECT id_pista FROM pedido, linea_pedido WHERE pedido.id_pedido = linea_pedido.id_pedido AND pedido.id_cliente = ?) ORDER BY id_pista desc LIMIT ? OFFSET ?");       # Preparar declaración
            $oMysqli_stmt->bind_param("siii", $_GET['genero'], $_SESSION['sesion']['id'], $vNumeroTarjetas, $_SESSION['offset']);                                 # Atar parámetros/variables
        }
        $oMysqli_stmt->execute();                                                       # Ejecutar consulta (query)
        $resultado = $oMysqli_stmt->get_result();

        // Comprobar si existe fila
        if ($resultado->num_rows > 0) {
            ?>
            <div class="<?php echo $vClaseSlider ?>">
                <section class="container my-5">
                    <h3 class="mb-4">Biblioteca personal</h3>
                    <div class="row g-4"> <!-- Línea con gaps -->
            <?php
            // Tarjeta
            while ($row = $resultado->fetch_assoc()) {
                // Identificar artista
                $oMysqli_stmt = $oMysqli->prepare("SELECT * FROM artista WHERE id_artista = ?");      # Preparar declaración
                $oMysqli_stmt->bind_param("i", $row['id_artista']);                         # Atar parámetros/variables
                $oMysqli_stmt->execute();                                                              # Ejecutar consulta (query)
                $resultadoArtista = $oMysqli_stmt->get_result();
                $rowArtista = $resultadoArtista->fetch_assoc();
                ?>    
                        <!-- Contenido -->
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <a class="album-card-link" href="playerPrep.php?id=<?php echo $row['id_pista'] ?>&titulo=<?php echo $row['titulo'] ?>&precio=<?php echo $row['precio'] ?>&nombre=<?php echo $rowArtista['nombre'] ?>">
                                <div class="card album-card text-light">
                                    <div class="album-cover" style="background-image: url('<?php echo $row['imagen'] ?>');"></div>
                                    <div class="card-body">
                                        <h6 class="card-title"><?php echo $row['titulo'] ?></h6>
                                        <p class="card-text text-secondary"><?php echo $rowArtista['nombre'] ?></p>
                                        <span class="fw-bold"><?php echo $row['precio'] ?>€</span>
                                    </div>
                                </div>
                            </a>
                        </div>
            <?php
            }
            ?>
                    </div>
                </section>
            </div><?php
        }
        ?>
    </div>

    <div class="container d-flex justify-content-center align-items-center gap-3 mb-5">
        <?php
        if ($_SESSION['pagina'] == 1) {
            ?>
            <button class="btn btn-dark" style="width: 100px;" disabled>Atrás</button>
            <?php
        } else {
            ?>
            <a href="biblioteca.php?atras"><button class="btn btn-dark" style="width: 100px;">Atrás</button></a>
            <?php
        }
        ?>
        <p class="mb-0">
            Página <?php echo $_SESSION['pagina'] ?> de <?php echo $_SESSION['techoPaginas'] ?>
        </p>
        <?php
        if ($_SESSION['pagina'] == $_SESSION['techoPaginas']) {
            ?>
            <button class="btn btn-dark" style="width: 100px;" disabled>Siguiente</button>
            <?php
        } else {
            ?>
            <a href="biblioteca.php?siguiente"><button class="btn btn-dark" style="width: 100px;">Siguiente</button></a>
            <?php
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts hacer saltar el popup -->
    <?php include "bodyScripts.php"; ?>
    
</body>

<!-- Módulo footer -->
<?php include "footer.php"; ?>

</html>