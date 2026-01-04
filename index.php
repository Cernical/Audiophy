<!-- Standalone -->

<?php
session_start();
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

        footer {
            background-color: #15151d;
        }
    </style>
</head>

<body>
    <!-- Módulo navbar -->
    <?php include "navbar.php"; ?>

    <!-- Slider -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <!-- Hero -->
                <section id="hero1" class="hero text-left">
                    <div class="container">
                        <h1 class="display-5 fw-bold">Descubre</h1>
                        <p class="lead fw-bold">Streaming musical y descargas en Hi-Res.</p>
                        <button class="btn btn-warning btn-lg mt-3">Navega el catálogo</button>
                    </div>
                </section>
            </div>
            <div class="carousel-item">
                <!-- Hero -->
                <section id="hero2" class="hero text-left">
                    <div class="container">
                        <h1 class="display-5 fw-bold">Explora</h1>
                        <p class="lead fw-bold">El mayor catálogo Hi-Res para streaming y descargas</p>
                        <button class="btn btn-warning btn-lg mt-3">Navega el catálogo</button>
                    </div>
                </section>
            </div>
            <div class="carousel-item">
                <!-- Hero -->
                <section id="hero3" class="hero text-left">
                    <div class="container">
                        <h1 class="display-5 fw-bold">Disfruta el sonido de los artistas</h1>
                        <p class="lead fw-bold">Compra y escucha en streaming los álbumes en alta calidad de tus
                            artistas favoritos.</p>
                        <button class="btn btn-warning btn-lg mt-3">Navega el catálogo</button>
                    </div>
                </section>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Featured pistas -->
    <div id="carouselExampleIndicatorsPistas" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicatorsPistas" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicatorsPistas" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicatorsPistas" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <!-- Sliders --------------------------------------------------------------------------------->
        <div class="carousel-inner">
            <?php
            $i = 1;
            $vNumeroTarjetas = 4;
            $vOffset = 0;
            $vOffsetSumador = $vNumeroTarjetas;

            while ($i <= 2) {
                // Consulta pistas
                $oMysqli_stmt = $oMysqli->prepare("SELECT * FROM pista LIMIT ? OFFSET ?");      # Preparar declaración
                $oMysqli_stmt->bind_param("ii", $vNumeroTarjetas, $vOffset);                         # Atar parámetros/variables
                $oMysqli_stmt->execute();                                                              # Ejecutar consulta (query)
                $resultado = $oMysqli_stmt->get_result();

                // Comprobar si existe fila
                if ($resultado->num_rows > 0) {
                    // Comprobar primer slider
                    if ($i == 1) {
                        $vClaseSlider = "carousel-item active";
                    } else {
                        $vClaseSlider = "carousel-item";
                    }
                    ?>
                    <!-- Slider -->
                    <div class="<?php echo $vClaseSlider ?>">
                        <section class="container my-5">
                            <h3 class="mb-4">Las novedades</h3>
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
                                    <div class="card album-card text-light">
                                        <div class="album-cover" style="background-image: url('<?= htmlspecialchars($row['imagen']) ?>');"></div>
                                        <div class="card-body">
                                            <h6 class="card-title"><?php echo $row['titulo'] ?></h6>
                                            <p class="card-text text-secondary"><?php echo $rowArtista['nombre'] ?></p>
                                            <span class="fw-bold"><?php echo $row['precio'] ?>€</span>
                                        </div>
                                    </div>
                                </div>
                    <?php
                    }
                    ?>
                            </div>
                        </section>
                    </div><?php
                }

                $vOffset = $vOffset + $vOffsetSumador;
                $i++;
            }
            ?>
        </div>
        <!-------------------------------------------------------------------------------------------->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicatorsPistas"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicatorsPistas"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
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
    <!--------------------------------------------------------------------------------------------->
</body>

</html>