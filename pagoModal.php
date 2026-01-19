<!-- Incluido de navbar -->
<!-- Pago Modal -->
<div class="modal fade" id="pagoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content login-card text-light">
            <div class="modal-header border-0">
                <h5 class="modal-title">Elija su método de pago</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="cesta.php" method="post">
                    <div class="mb-3">
                        <?php
                        if (isset($_POST['pPago'])) {
                            if ($_POST['pMetodo'] == "tarjeta") {
                                ?>
                                <label for="numero">Número de tarjeta</label>
                                <?php
                                if (isset($_SESSION['sesion']['tarjeta'])) {
                                    ?>
                                    <input type="text" class="form-control" name="pTarjeta" minlength="16" maxlength="16" placeholder="0123456789012345" value="<?php echo $_SESSION['sesion']['tarjeta'] ?>" required>
                                    <?php
                                } else {
                                    ?>
                                    <input type="text" class="form-control" name="pTarjeta" minlength="16" maxlength="16" placeholder="0123456789012345" required>
                                    <?php
                                }
                                ?>
                                <input type="checkbox" name="pGuardar" id="guardar">
                                <label for="guardar">Guardar su tarjeta para futuras compras</label>
                                <?php
                            }
                        } else {
                            ?>
                            <label for="metodo">Método</label>
                            <select class="form-select" id="metodo" name="pMetodo" required>
                                    <option value="tarjeta">Tarjeta Bancaria</option>
                            </select>
                            <?php
                        }
                        ?>
                    </div>
                    <input class="btn btn-primary w100" type="submit" name="pPago" value="Continuar">
                </form>
            </div>
        </div>
    </div>
</div>