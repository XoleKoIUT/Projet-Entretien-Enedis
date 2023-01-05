<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: pageConnexion.php');
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale">
    <title> <?= $user ?> </title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="chat">
    <div class="email_btn">
        <span> <?= $user ?> </span>
        <a href="deconnexion.php" class="deconnexion_btn"> Déconnexion </a>
    </div>
    <!-- Messages -->
    <div class="messages_box"> Chargement.... </div>
    <!-- Fin des messages -->
    <?php
    if (isset($_POST['envoi'])) {
        /* Permet de récupérer le message que l'utilisateur a écrit */
        $message = $_POST['message'];
        include 'connexionBDD.php';
        if (isset($message) && $message != "") {
            /* Insertion du message dans la base de données */
            $req = mysqli_query($con, "INSERT INTO messages VALUES (NULL, '$user', '$message', NOW())");
            header('Location: chat.php');
        } else {
            /* Actualisation de la page */
            header('Location: chat.php');
        }
    }
    ?>
    <form action="" class="envoi_message" method="POST">
        <textarea name="message" cols="40" rows="2" placeholder="Votre message"> </textarea>
        <input type="submit" value="Envoyé" name="envoi">
    </form>
</div>
<script>
    // On actualise automatique le chat en utilisant AJAX
    var message_box = document.querySelector('.messages_box');
    setInterval(function () {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                message_box.innerHTML = this.responseText;
            }
        };
        /* Récupération de la page message */
        xhttp.open("GET", "pageMessagerie.php", true);
        xhttp.send()
    }, 50) // Actualiser le chat tous les 50 ms
</script>
</body>
</html>