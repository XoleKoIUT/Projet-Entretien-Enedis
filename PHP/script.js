/* ---------------------------------------------------------------- */
/*                   Confirmation du mot de passe                   */
/* ---------------------------------------------------------------- */

var mdp1 = document.querySelector('.mdp1');
var mdp2 = document.querySelector('.mdp2');

mdp2.onkeyup = function () {
    message_error = document.querySelector('.message_error');
    /* Vérification de l'égalité des mots de passe*/
    if (mdp1.value != mdp2.value) {
        message_error.innerText = "Mot de passes ne sont pas conformes";
    } else {
        message_error.innerText = ""; /* Car les mots de passe sont conformes entre eux */
    }
}