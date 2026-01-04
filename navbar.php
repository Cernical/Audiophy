<!-- Incluido de index -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php"><img src="./media/logo-white.png" alt="Audiophy logo"
                style="width:30%;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="#home">Descubre</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Géneros</a></li>
                <li class="nav-item me-3"><a class="nav-link" href="#">Lista</a></li>
            </ul>
            <?php
            if (isset($_SESSION['sesion'])) {
                $aSesion = $_SESSION['sesion'];
                ?>
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-person"></i> <?php echo $aSesion['nombre']; ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Perfil</a>
                        <a class="dropdown-item" href="#">Biblioteca</a>
                        <a class="dropdown-item" href="logout.php">Cerrar sesión</a>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <button class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <i class="bi bi-person"></i> Iniciar Sesión
                </button>
                <button class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#registerModal">Registrarse
                </button>
                <?php
            }
            ?>
        </div>
    </div>
</nav>

<!-- Módulo login popup modal -->
<?php include "loginModal.php"; ?>

<!-- Módulo register popup modal -->
<?php include "registerModal.php"; ?>