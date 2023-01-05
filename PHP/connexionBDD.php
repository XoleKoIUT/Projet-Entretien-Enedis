<?php
$con = mysqli_connect("localhost", "root", "", "projet_enedis");
$req = mysqli_query($con, "SET NAMES UTF8");
if (!$con) {
    echo "Connexion à la base de données échouée";
}
?>