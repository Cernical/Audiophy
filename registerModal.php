<!-- Incluido de navbar -->
<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content login-card text-light">
            <div class="modal-header border-0">
                <h5 class="modal-title">Registrarse</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="register.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="pEmail" placeholder="tu@ejemplo.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="pNombre" placeholder="ejemplo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="pSecreto" placeholder="••••••••" required>
                    </div>
                    <input class="btn btn-primary w100" type="submit" name="pRegistrar" value="Continuar">
                </form>
                <?php
                if (isset($_GET["registrado"])) {
                    ?>
                    <div class="alert alert-success mt-3" role="alert">
                        Registrado correctamente
                    </div>
                    <?php
                }
                if (isset($_GET["register_duplicado"])) {
                    ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        Usuario ya registrado
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>