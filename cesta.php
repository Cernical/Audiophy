<!-- Standalone -->

<?php
session_start();
$_SESSION['paginaActual'] = "index.php";    # En caso de cerrar sesión
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Reiniciar factura para volver a contar
unset($_SESSION['factura']);

// Limpiar cesta
if (isset($_GET['vaciar'])) {
    unset($_SESSION['cesta']);
    unset($_SESSION['pista']);
    header("Location: index.php");
    exit();
}

include "conexion.php";

// Conseguir pista y actualizar cesta
if (isset($_SESSION['cesta'])) {
    $dCesta = $_SESSION['cesta'];                               # Conseguir diccionario de la sesión
    $dCesta[$_SESSION['pista']['id']] = [$_SESSION['pista']];   # Actualizar diccionario
    $_SESSION['cesta'] = $dCesta;                               # Volver a guardar a sesión
} else {
    // Crear cesta al no existir aún la cesta
    $dCesta[$_SESSION['pista']['id']] = [$_SESSION['pista']];
    $_SESSION['cesta'] = $dCesta;
}
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
        .cover {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
            transition: transform 0.2s ease;
        }

        .cover:hover {
            transform: scale(1.18);
        }

        body {
            background-color: #0f0f14;
            color: #eaeaf0;
        }

        .tabla {
            --bs-table-bg: #0f0f14;
            --bs-table-color: #eaeaf0;
            --bs-table-hover-bg: #15151d;
            --bs-table-hover-color: #eaeaf0;
        }

        .border-bottom-0 td {
            border-bottom: 0 !important;
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
    <h2 class="container my-4">Cesta</h2>

    <div class="container d-flex justify-content-center align-items-center gap-3 mt-3">
        <table class="table tabla align-middle table-hover">
            <thead>
                <!-- Cabeceras -->
                <tr>
                    <th scope="col">Título</th>
                    <th scope="col">Artista</th>
                    <th scope="col">Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($dCesta as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $value[0]['titulo'] ?></td>
                        <td><?php echo $value[0]['nombre'] ?></td>
                        <td><?php echo $value[0]['precio'] ?></td>
                    </tr>
                    <?php
                    if (isset($_SESSION['factura'])) {
                        $_SESSION['factura'] = $_SESSION['factura'] + $_SESSION['pista']['precio'];
                    } else {
                        $_SESSION['factura'] = $_SESSION['pista']['precio'];
                    }
                }
                ?>
                <tr class="border-bottom-0">
                    <td class="fw-bold">Total</td>
                    <td></td>
                    <td class="fw-bold"><?php echo $_SESSION['factura'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container d-flex justify-content-center align-items-center gap-3 mt-5 mb-3">
        <a href="cesta.php?vaciar"><button class="btn btn-dark fw-bold" style="width: 220px;">Vaciar cesta</button></a>
        <a href="pago.php"><button class="btn btn-primary fw-bold" style="width: 220px;">Continuar con el pago</button></a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>

<!-- Módulo footer -->
<?php include "footer.php"; ?>

</html>