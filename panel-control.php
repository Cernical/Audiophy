<!-- Standalone -->

<?php
session_start();
$_SESSION['paginaActual'] = "panel-control.php";
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
    <div class="container d-flex justify-content-center align-items-center gap-3 mt-3">
        <?php
        // Cambiar colores según toggle
        $aTablasDatos = ["admin", "album", "artista", "cliente", "pista"];

        foreach ($aTablasDatos as $key => $value) {
            if (isset($_GET['datos']) and ($_GET['datos']) == $value) {
                $vClase = "light";
            } else {
                $vClase = "dark";
            }
            ?>
            <a href="panel-control.php?datos=<?php echo $value ?>"><button class="btn btn-<?php echo $vClase ?>" style="width: 100px;"><?php echo ucfirst($value) ?></button></a>
            <?php
        }
        ?>
    </div>

    <div class="container d-flex justify-content-center align-items-center gap-3 my-5">
        <?php
        if (!isset($_GET['datos'])) {
            ?>
            <h2>Bienvenido, <?php echo $_SESSION['sesion']['nombre'] ?></h2>
            <?php
        }
        ?>
    </div>
    
    <?php
    if (isset($_GET['datos']) and ($_GET['datos']) == "admin") {
        ?>
        <div class="container my-5">
            <form action="gestorDatos.php" method="post">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="pEmail" placeholder="tu@ejemplo.com" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="pNombre" placeholder="Tu usuario" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="pSecreto" placeholder="••••••••" required>
                </div>
                <input class="btn btn-primary w100" type="submit" name="pAdmin" value="Añadir">
            </form>
            <?php
            if (isset($_GET["admin"]) and ($_GET["admin"] == "1")) {
                ?>
                <div class="alert alert-success mt-3" role="alert">
                    Entrada añadida con éxito.
                </div>
                <?php
            }
            if (isset($_GET["admin"]) and ($_GET["admin"] == "0")) {
                ?>
                <div class="alert alert-danger mt-3" role="alert">
                    Datos duplicados.
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>

    <?php
    if (isset($_GET['datos']) and ($_GET['datos']) == "album") {
        ?>
        <div class="container my-5">
            <form action="gestorDatos.php" method="post">
                <div class="mb-3">
                    <label for="artistas">Artistas</label>
                    <select class="form-select" id="artista" name="pArtista" required>
                        <?php
                        $oMysqli_stmt = $oMysqli->prepare("SELECT * FROM artista");      # Preparar declaración
                        $oMysqli_stmt->execute();                                                              # Ejecutar consulta (query)
                        $resultadoArtista = $oMysqli_stmt->get_result();
                        while ($rowArtista = $resultadoArtista->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $rowArtista['id_artista'] ?>"><?php echo $rowArtista['nombre'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ruta imagen</label>
                    <input type="text" class="form-control" name="pRuta" placeholder="./media/albumes/caratula.jpg" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" class="form-control" name="pTitulo" placeholder="Título" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <input type="text" class="form-control" name="pDescripcion" placeholder="Texto descriptivo">
                </div>
                <div class="mb-3">
                    <label for="genero">Género</label>
                    <select class="form-select" id="genero" name="pGenero" required>
                            <option value="Rock">Rock</option>
                            <option value="Jazz">Jazz</option>
                            <option value="Electrónica">Electrónica</option>
                            <option value="Clásica">Clásica</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="datetime" class="form-control" name="pFecha" placeholder="2025-12-30 00:00:00" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Precio</label>
                    <input type="number" class="form-control" name="pPrecio" step="0.01" placeholder="5.76" required>
                </div>
                <input class="btn btn-primary w100" type="submit" name="pAlbum" value="Añadir">
            </form>
            <?php
            if (isset($_GET["album"]) and ($_GET["album"] == "1")) {
                ?>
                <div class="alert alert-success mt-3" role="alert">
                    Entrada añadida con éxito.
                </div>
                <?php
            }
            if (isset($_GET["album"]) and ($_GET["album"] == "0")) {
                ?>
                <div class="alert alert-danger mt-3" role="alert">
                    Datos duplicados.
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>

    <?php
    if (isset($_GET['datos']) and ($_GET['datos']) == "artista") {
        ?>
        <div class="container my-5">
            <form action="gestorDatos.php" method="post">
                <div class="mb-3">
                    <label class="form-label">Ruta imagen</label>
                    <input type="text" class="form-control" name="pRuta" placeholder="./media/artista/artista.jpg" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="pNombre" placeholder="Título" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Origen</label>
                    <input type="text" class="form-control" name="pOrigen" placeholder="País origen">
                </div>
                <input class="btn btn-primary w100" type="submit" name="pArtista" value="Añadir">
            </form>
            <?php
            if (isset($_GET["artista"]) and ($_GET["artista"] == "1")) {
                ?>
                <div class="alert alert-success mt-3" role="alert">
                    Entrada añadida con éxito.
                </div>
                <?php
            }
            if (isset($_GET["artista"]) and ($_GET["artista"] == "0")) {
                ?>
                <div class="alert alert-danger mt-3" role="alert">
                    Datos duplicados.
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>

    <?php
    if (isset($_GET['datos']) and ($_GET['datos']) == "cliente") {
        ?>
        <div class="container my-5">
            <form action="gestorDatos.php" method="post">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="pEmail" placeholder="tu@ejemplo.com" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="pNombre" placeholder="Tu usuario" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="pSecreto" placeholder="••••••••" required>
                </div>
                <input class="btn btn-primary w100" type="submit" name="pCliente" value="Añadir">
            </form>
            <?php
            if (isset($_GET["cliente"]) and ($_GET["cliente"] == "1")) {
                ?>
                <div class="alert alert-success mt-3" role="alert">
                    Entrada añadida con éxito.
                </div>
                <?php
            }
            if (isset($_GET["cliente"]) and ($_GET["cliente"] == "0")) {
                ?>
                <div class="alert alert-danger mt-3" role="alert">
                    Datos duplicados.
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>

    <?php
    if (isset($_GET['datos']) and ($_GET['datos']) == "pista") {
        ?>
        <div class="container my-5">
            <form action="gestorDatos.php" method="post">
                <div class="mb-3">
                    <label for="artistas">Artistas</label>
                    <select class="form-select" id="artista" name="pArtista" required>
                        <?php
                        $oMysqli_stmt = $oMysqli->prepare("SELECT * FROM artista");      # Preparar declaración
                        $oMysqli_stmt->execute();                                                              # Ejecutar consulta (query)
                        $resultadoArtista = $oMysqli_stmt->get_result();
                        while ($rowArtista = $resultadoArtista->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $rowArtista['id_artista'] ?>"><?php echo $rowArtista['nombre'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="albumes">Álbumes</label>
                    <select class="form-select" id="albumes" name="pAlbumes">
                        <?php
                        $oMysqli_stmt = $oMysqli->prepare("SELECT * FROM album");      # Preparar declaración
                        $oMysqli_stmt->execute();                                                              # Ejecutar consulta (query)
                        $resultadoAlbumes = $oMysqli_stmt->get_result();
                        while ($rowAlbumes = $resultadoAlbumes->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $rowAlbumes['id_album'] ?>"><?php echo $rowAlbumes['titulo'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ruta audio</label>
                    <input type="text" class="form-control" name="pAudio" placeholder="./media/pista/audio.flac" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ruta imagen</label>
                    <input type="text" class="form-control" name="pRuta" placeholder="./media/pista/caratula.jpg" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" class="form-control" name="pTitulo" placeholder="Título">
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <input type="text" class="form-control" name="pDescripcion" placeholder="Texto descriptivo">
                </div>
                <div class="mb-3">
                    <label for="genero">Género</label>
                    <select class="form-select" id="genero" name="pGenero" required>
                            <option value="Rock">Rock</option>
                            <option value="Jazz">Jazz</option>
                            <option value="Electrónica">Electrónica</option>
                            <option value="Clásica">Clásica</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="datetime" class="form-control" name="pFecha" placeholder="2025-12-30 00:00:00" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Precio</label>
                    <input type="number" class="form-control" name="pFecha" placeholder="5.76" required>
                </div>
                <input class="btn btn-primary w100" type="submit" name="pPista" value="Añadir">
            </form>
            <?php
            if (isset($_GET["pista"]) and ($_GET["pista"] == "1")) {
                ?>
                <div class="alert alert-success mt-3" role="alert">
                    Entrada añadida con éxito.
                </div>
                <?php
            }
            if (isset($_GET["pista"]) and ($_GET["pista"] == "0")) {
                ?>
                <div class="alert alert-danger mt-3" role="alert">
                    Datos duplicados.
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>    
</body>

<!-- Módulo footer -->
<?php include "footer.php"; ?>

</html>