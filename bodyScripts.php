<!-- Scripts hacer saltar el popup -->
<?php if (isset($_GET['register_duplicado'])) {
    ?>
    <script>document.querySelector('[data-bs-target="#registerModal"]').click();</script><?php
} ?>

<?php if (isset($_GET['registrado'])) {
    ?>
    <script>document.querySelector('[data-bs-target="#registerModal"]').click();</script><?php
} ?>

<?php if (isset($_SESSION['login_failed'])) {
    ?>
    <script>document.querySelector('[data-bs-target="#loginModal"]').click();</script><?php
    unset($_SESSION['login_failed']);
} ?>
<!--------------------------------------------------------------------------------------------->