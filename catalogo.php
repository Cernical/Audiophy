<!-- Standalone -->

<?php
session_start();
$_SESSION['paginaActual'] = "index.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts hacer saltar el popup -->
    <?php include "bodyScripts.php"; ?>
    
</body>

<!-- Módulo footer -->
<?php include "footer.php"; ?>

</html>