<?php
session_start();
if (isset($_SESSION['user'])) {
    include "connexionBDD.php";
    $req = mysqli_query($con, "SELECT * FROM messages ORDER BY idMess");
    if (mysqli_num_rows($req) == 0) {
        echo "Aucun message";
    } else {
        while ($row = mysqli_fetch_assoc($req)) {
            if ($row['emailMess'] == $_SESSION['user']) {
                ?>
                <div class="message your_message">
                    <span> Vous </span>
                    <p> <?= $row['msg'] ?> </p>
                    <p class="date"> <?= $row['dateMsg'] ?></p>
                </div>
                <?php
            } else {
                ?>
                <div class="message other_message">
                    <span> <?= $row['emailMess'] ?> </span>
                    <p> <?= $row['msg'] ?> </p>
                    <p class="date"> <?= $row['dateMsg'] ?></p>
                </div>
                <?php
            }
        }
    }
}
?>