<!-- Standalone -->

<?php
session_start();
$_SESSION['paginaActual'] = "index.php";    # Al cerrar sesión
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "conexion.php";

// Comprobar formulario
$bEditado = False;
if (isset($_POST['pPerfil'])) {
    foreach ($_POST as $key => $value) {
        // Editar si contiene valor y no es el botón de editar
        if (($value) and ($key != "pPerfil")) {
            // Comprobar si es contraseña
            if ($key == "contraseña") {
                    $value = password_hash($value, PASSWORD_DEFAULT);                      # Default alg.
            }
            $oMysqli_stmt = $oMysqli->prepare("UPDATE cliente SET $key = ? WHERE id_cliente = ?");     # Preparar declaración
            $oMysqli_stmt->bind_param("si", $value, $_SESSION['sesion']['id']);                        # Atar parámetros/variables
            $oMysqli_stmt->execute(); # Ejecutar consulta (query)
            $bEditado = True;
        }
    }
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
    <div class="container d-flex justify-content-center align-items-center gap-3 my-5">
        <h2>Bienvenido, <?php echo $_SESSION['sesion']['nombre'] ?></h2>
    </div>
    
    <div class="container my-5">
        <form action="perfil.php" method="post">
            <div class="mb-3">
                <h3><label class="form-label">Mi cuenta</label></h3>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="correo" placeholder="<?php echo $_SESSION['sesion']['email'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="<?php echo $_SESSION['sesion']['nombre'] ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="contraseña" placeholder="••••••••">
            </div>
            <div class="mb-3">
                <label class="form-label">Dirección de facturación</label>
                <input type="text" class="form-control" name="direccion" maxlength="64" placeholder="41530, Morón de la Frontera, Sevilla, España">
            </div>
            <div class="mb-3">
                <label class="form-label">Tarjeta</label>
                <input type="text" class="form-control" name="tarjeta" minlength="16" maxlength="16" placeholder="0123456789012345">
            </div>
            <input class="btn btn-primary w100" type="submit" name="pPerfil" value="Actualizar">
        </form>
        <?php
        if (isset($_POST['pPerfil'])) {
            ?>
            <div class="alert alert-success mt-3" role="alert">
                Entrada editada con éxito.
            </div>
            <?php
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>    
</body>

<!-- Módulo footer -->
<?php include "footer.php"; ?>

</html>