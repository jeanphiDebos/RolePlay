<?php
function generateurSession()
{
    $possible = "azertyupqsdfghjkmwxcvbn0123456789AZERTYUPQSDFGHJKMWXCVBN";
    $session = "";

    for ($i = 0; $i < 15; $i++) {
        $alea = mt_rand(0, strlen($possible) - 1);
        $caractere = substr($possible, $alea, 1);
        $session .= $caractere;
    }

    return $session;
}

$erreur = "";

if ($_SESSION['perso'] != "") {
    if (empty($_SESSION['idSession'])) $_SESSION['idSession'] = generateurSession();
    if ($action == "fichePerso") include("./vueFichePerso.php");
    else if ($action == "listeMessage") include("./vueListeMessage.php");
}
?>