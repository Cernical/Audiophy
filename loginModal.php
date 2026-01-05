<!-- Incluido de navbar -->
<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content login-card text-light">
            <div class="modal-header border-0">
                <h5 class="modal-title">Iniciar sesión</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="login.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <?php
                        if (isset($_SESSION["login_failed"])) {
                            ?>
                            <input type="email" class="form-control" name="pEmail" value="<?php echo $_SESSION["login_failed"] ?>" placeholder="tu@ejemplo.com" required>
                            <?php
                        } else {
                            ?>
                            <input type="email" class="form-control" name="pEmail" placeholder="tu@ejemplo.com" required>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="pSecreto" placeholder="••••••••" required>
                    </div>
                    <input class="btn btn-primary w100" type="submit" name="pLogin" value="Continuar">
                </form>
                <?php
                if (isset($_SESSION["login_failed"])) {
                    ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        Ups, eso no funcionó, pruebe otra vez.
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>