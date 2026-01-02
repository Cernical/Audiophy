<!-- Standalone -->

<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
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
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .hero {
            background: linear-gradient(135deg, #1c1c2b, #0f0f14);
            padding: 20rem 1rem;
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
            background-color: #2a2a3d;
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

    <!-- Hero -->
    <section id="home" class="hero text-center">
        <div class="container">
            <h1 class="display-5 fw-bold">Tienda de música Hi-Res</h1>
            <p class="lead text-secondary">Compra y escucha en streaming los álbumes en alta calidad de tus artistas
                favoritos.</p>
            <button class="btn btn-primary btn-lg mt-3">Navega el catálogo</button>
        </div>
    </section>

    <!-- Featured Albums -->
    <section class="container my-5">
        <h3 class="mb-4">Pistas destacadas</h3>
        <div class="row g-4">
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card album-card text-light">
                    <div class="album-cover"></div>
                    <div class="card-body">
                        <h6 class="card-title">Plantilla</h6>
                        <p class="card-text text-secondary">Plantilla</p>
                        <span class="fw-bold">€12.99</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card album-card text-light">
                    <div class="album-cover"></div>
                    <div class="card-body">
                        <h6 class="card-title">Plantilla</h6>
                        <p class="card-text text-secondary">Plantilla</p>
                        <span class="fw-bold">€9.99</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card album-card text-light">
                    <div class="album-cover"></div>
                    <div class="card-body">
                        <h6 class="card-title">Plantilla</h6>
                        <p class="card-text text-secondary">Plantilla</p>
                        <span class="fw-bold">€11.49</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card album-card text-light">
                    <div class="album-cover"></div>
                    <div class="card-body">
                        <h6 class="card-title">Plantilla</h6>
                        <p class="card-text text-secondary">Plantilla</p>
                        <span class="fw-bold">€14.99</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Módulo footer -->
    <?php include "footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Scripts popup -->
    <?php if (isset($_GET['register_duplicado'])) {
        ?><script>document.querySelector('[data-bs-target="#registerModal"]').click();</script><?php
    } ?>

    <?php if (isset($_GET['registrado'])) {
        ?><script>document.querySelector('[data-bs-target="#registerModal"]').click();</script><?php
    } ?>

    <?php if (isset($_GET['login_failed'])) {
        ?><script>document.querySelector('[data-bs-target="#loginModal"]').click();</script><?php
    } ?>
</body>

</html>