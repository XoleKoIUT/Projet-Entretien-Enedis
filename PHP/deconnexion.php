<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: pageConnexion.php');
}
session_destroy();
header('Location: pageConnexion.php');
?>