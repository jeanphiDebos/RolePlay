<?php
require_once("../model/PDOBDD.php");
require_once("../model/requeteurSQL.php");

$erreur = "";
$requeteurSQL = new requeteurSQL();
$pathUploadFichier = ".";

if ($action == "fichePerso") {
    $listePersonnages = $requeteurSQL->getDonnees("personnage", "");

    if ($requeteurSQL->getErreur()) {
        $erreur = $requeteurSQL->getMessageErreur();
    }

    include("./headerMenu.php");
    include("./vuePersonnage.php");
} else if ($action == "carte") {
    $pathUploadFichier = "../carte/image";
    $listeCartes = $requeteurSQL->getDonnees("carte", "");

    if ($requeteurSQL->getErreur()) {
        $erreur = $requeteurSQL->getMessageErreur();
    }

    include("./headerMenu.php");
    include("./vueCarte.php");
} else if ($action == "listeMessage") {
    $listeMessage = $requeteurSQL->getDonneesByChamp("message", "idPerso", "0", " ORDER BY `id` ASC");

    if ($requeteurSQL->getErreur()) {
        $erreur = $requeteurSQL->getMessageErreur();
    }

    include("./headerMenu.php");
    include("./vueListeMessage.php");
} else if ($action == "JouerSon") {
    $pathUploadFichier = "../admin/son";
    $listePersonnages = $requeteurSQL->getDonnees("personnage", "");

    if ($requeteurSQL->getErreur()) {
        $erreur .= $requeteurSQL->getMessageErreur();
    }

    include("./headerMenu.php");
    include("./vueManagerSon.php");
} else if ($action == "bestiaire") {
    $pathUploadFichier = "../bestiaire/image";
    $listeBestiaire = $requeteurSQL->getDonnees("bestiaire", "");

    if ($requeteurSQL->getErreur()) {
        $erreur = $requeteurSQL->getMessageErreur();
    }

    include("./headerMenu.php");
    include("./vueBestiaire.php");
} else if ($action == "navire") {
    $listeNavire = $requeteurSQL->getDonnees("navire", "");

    if ($requeteurSQL->getErreur()) {
        $erreur = $requeteurSQL->getMessageErreur();
    }

    include("./headerMenu.php");
    include("./vueNavire.php");
}
?>