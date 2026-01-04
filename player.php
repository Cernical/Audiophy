<!-- Standalone -->

<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "conexion.php";

// Conseguir pista
$oMysqli_stmt = $oMysqli->prepare("SELECT titulo, audio, imagen, descripcion, precio FROM pista WHERE id_pista = ?");
$oMysqli_stmt->bind_param("i", $_GET['id']);
$oMysqli_stmt->execute();
$pista = $oMysqli_stmt->get_result()->fetch_assoc();
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
        /* Heredado de index.php */
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

        /* player.php */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background-image: url("<?php echo $pista['imagen']; ?>");
            background-size: cover;
            background-position: center;
            filter: blur(10px) brightness(0.5);
            z-index: -1;
        }

        .player {
            width:720px;
            background:#1b1b25;
            border-radius:16px;
            padding:20px;
            text-align:center;
        }
        .player img {
            width:100%;
            border-radius:12px;
            margin-bottom:12px;
            min-width: 180px;
            height: 575px;
            object-fit: cover;
        }
        audio {
            width:100%;
        }
    </style>
</head>

<body>
    <!-- Módulo navbar -->
    <?php include "navbar.php"; ?>

    <!-- Reproductor -->
    <div class="container d-flex justify-content-center">
        <div class="player">
            <img src="<?php echo $pista['imagen']; ?>" alt="Cover">

            <div class="title fw-bold"><?php echo $pista['titulo']; ?></div>

            <?php if ($pista['descripcion']) { ?>
                <div class="desc"><?php echo $pista['descripcion'] ?></div>
            <?php } ?>

            <div class="mb-3 text-secondary"><?php echo $_GET['nombre'] ?></div>
            
            <!-- Reproductor enlazado a JS -->
            <audio id="audio" controls autoplay>
                <source src="<?php echo $pista['audio']; ?>" type="audio/mpeg">
            </audio>

            <!-- Contador enlazado a JS -->
            <div id="timer">Iniciar prueba</div>
            
            <!-- Comprar -->
            <div>
                <button class="fw-bold btn btn-warning my-3">Comprar: <?php echo $pista['precio']; ?> €</button>
            </div>
        </div>
    </div>

    <!-- Módulo footer -->
    <?php include "footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts hacer saltar el popup -->
    <?php if (isset($_GET['register_duplicado'])) {
        ?>
        <script>document.querySelector('[data-bs-target="#registerModal"]').click();</script><?php
    } ?>

    <?php if (isset($_GET['registrado'])) {
        ?>
        <script>document.querySelector('[data-bs-target="#registerModal"]').click();</script><?php
    } ?>

    <?php if (isset($_GET['login_failed'])) {
        ?>
        <script>document.querySelector('[data-bs-target="#loginModal"]').click();</script><?php
    } ?>
    <!----------------------------------->

    <!-- Script player -->
    <script>
    const audio = document.getElementById('audio'); // Enlazado al reproductor
    const timer = document.getElementById('timer'); // Enlazado al contador
    const vTiempoLimite = 30;                       // Tiempo de prueba

    audio.addEventListener('timeupdate', () => {
        const vTiempoRestante = Math.max(0, vTiempoLimite - audio.currentTime);
        timer.textContent = Math.ceil(vTiempoRestante) + "s restantes";

        if (audio.currentTime >= vTiempoLimite) {
            audio.pause();
            audio.currentTime = vTiempoLimite;      // Evita comprobar de nuevo
            timer.textContent = "Se acabó la prueba";
        }
    });
    </script>
</body>

</html>

