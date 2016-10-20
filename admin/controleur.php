<?php
require_once("../model/PDOBDD.php");
require_once("../model/requeteurSQL.php");

$erreur = "";
$requeteurSQL = new requeteurSQL();
$pathUploadFichier = ".";

include("./headerMenu.php");

if ($action == "fichePerso"){
    $listePersonnages = $requeteurSQL->getListePersonnages();

    if ($requeteurSQL->getErreur()){
        $erreur = $requeteurSQL->getMessageErreur();
    }

    include("./vuePersonnage.php");
}else if ($action == "carte"){
    $pathUploadFichier = "../carte/image";
    $listeCartes = $requeteurSQL->getListeCartes();

    if ($requeteurSQL->getErreur()){
        $erreur = $requeteurSQL->getMessageErreur();
    }

    include("./vueCarte.php");
}else if ($action == "listeMessage"){
    $listeMessage = $requeteurSQL->getMessagesJoueurs();

    if ($requeteurSQL->getErreur()){
        $erreur = $requeteurSQL->getMessageErreur();
    }

    include("./vueListeMessage.php");
}else if ($action == "JouerSon"){
    $pathUploadFichier = "../admin/son";
    $listePersonnages = $requeteurSQL->getListePersonnages();

    if ($requeteurSQL->getErreur()){
        $erreur .= $requeteurSQL->getMessageErreur();
    }

    include("./vueManagerSon.php");
}else if ($action == "bestiaire"){
    $pathUploadFichier = "../bestiaire/image";
    $listebestiaire = $requeteurSQL->getListebestiaire();

    if ($requeteurSQL->getErreur()){
        $erreur = $requeteurSQL->getMessageErreur();
    }

    include("./vueBestiaire.php");
}
?>