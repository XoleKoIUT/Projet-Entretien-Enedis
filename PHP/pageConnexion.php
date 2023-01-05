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
if (isset($_POST['btnConnexion'])) {
    /* En cas d'envois du formulaire de connexion */
    include 'connexionBDD.php';

    /* Récupération des données du formulaire */
    extract($_POST);

    /* Vérification du remplissage des champs */
    if (isset($email) && isset($mdp1) && $email != "" && $mdp1 != "") {
        $req = mysqli_query($con, "SELECT * FROM utilisateurs WHERE emailUser = '$email' AND mdpUser = '$mdp1'");
        if (mysqli_num_rows($req) > 0) {
            $_SESSION['user'] = $email;
            header('Location: chat.php');
            unset($_SESSION['message']);
        } else {
            /* Si les identifiants sont incorrects */
            $error = "Email ou mot de passe incorrect(s)";
        }
    } else {
        /* Si les champs demandés ne sont pas remplis */
        $error = "Veuillez remplir tous les champs";
    }
}
?>
<form action="" method="POST" class="form_connexion_inscription">
    <h1> Connexion </h1>
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
    }
    ?>
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
    <input type="password" name="mdp1">
    <input type="submit" value="Connexion" name="btnConnexion">

    <p class="link"> Vous n'avez pas de compte ? <a href="pageInscription.php"> Créer un compte</a></p>
</form>
</body>
</html>