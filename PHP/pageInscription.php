<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale">
    <title>Chat en Ligne</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<?php
if (isset($_POST['btnInscription'])) {
    include 'connexionBDD.php';
    extract($_POST);

    if (isset($email) && isset($mdp1) && isset($mdp2) && $email != "" && $mdp1 != "" && $mdp2 != "") {
        if ($mdp2 != $mdp1) {
            $error = "Les mots de passe ne correspondent pas";
        } else {
            $req = mysqli_query($con, "SELECT * FROM utilisateurs WHERE emailUser = '$email'");
            if (mysqli_num_rows($req) > 0) {
                $error = "L'adresse mail est déjà utilisée";
            } else {
                $req = mysqli_query($con, "INSERT INTO utilisateurs VALUES (NULL, '$email', '$mdp1')");
                if ($req) {
                    $_SESSION['message'] = "<p class='message_success'>Inscription réussie</p>";
                    header('Location: pageConnexion.php');
                } else {
                    $error = "Une erreur est survenue lors de la création de votre compte";
                }
            }
        }
    } else {
        $error = "Veuillez remplir tous les champs";
    }
}
?>
<form action="" method="POST" class="form_connexion_inscription">
    <h1> Inscription </h1>
    <p class="message_error">
        <?php
        if (isset($error)) {
            echo $error;
        }
        ?>
    </p>
    <label> Adresse Mail </label>
    <input type="email" name="email">

    <label> Mot de passe </label>
    <input type="password" name="mdp1" class="mdp1">

    <label> Confirmation du Mot de passe </label>
    <input type="password" name="mdp2" class="mdp2">

    <input type="submit" value="Inscription" name="btnInscription">

    <p class="link"> Vous avez un compte ? <a href="pageConnexion.php"> Se connecter </a></p>
</form>
<!-- Appel du code javascript -->
<script src="script.js"></script>
</body>
</html>