<?php
require_once("./PDOBDD.php");
require_once("./requeteurSQL.php");

/**
 * parametres d'entrer du model
 */
$action = isset($_GET['action']) ? addslashes($_GET['action']) : "";
$nomPersonnage = isset($_GET['nomPersonnage']) ? addslashes($_GET['nomPersonnage']) : "";
$IDPersonnage = isset($_GET['IDPersonnage']) ? addslashes($_GET['IDPersonnage']) : "";
$champPersonnage = isset($_GET['champPersonnage']) ? addslashes($_GET['champPersonnage']) : "";
$valeurPersonnage = isset($_GET['valeurPersonnage']) ? addslashes($_GET['valeurPersonnage']) : "";
$message = isset($_GET['message']) ? addslashes($_GET['message']) : "";
$idCarte = isset($_GET['idCarte']) ? addslashes($_GET['idCarte']) : "";
$nomCarte = isset($_GET['nomCarte']) ? addslashes($_GET['nomCarte']) : "";
$imageCarte = isset($_GET['imageCarte']) ? addslashes($_GET['imageCarte']) : "";
$axeVertical = isset($_GET['axeVertical']) ? addslashes($_GET['axeVertical']) : "";
$axeHorizontal = isset($_GET['axeHorizontal']) ? addslashes($_GET['axeHorizontal']) : "";
$typeAffichage = isset($_GET['typeAffichage']) ? addslashes($_GET['typeAffichage']) : "";
$cheminSon = isset($_GET['cheminSon']) ? addslashes($_GET['cheminSon']) : "";
$dateLancementClient = isset($_GET['dateLancementClient']) ? addslashes($_GET['dateLancementClient']) : "";
$idSession = isset($_GET['idSession']) ? addslashes($_GET['idSession']) : "";
$IDMonstre = isset($_GET['IDMonstre']) ? addslashes($_GET['IDMonstre']) : "";
$nomMonstre = isset($_GET['nomMonstre']) ? addslashes($_GET['nomMonstre']) : "";
$champMonstre = isset($_GET['champMonstre']) ? addslashes($_GET['champMonstre']) : "";
$valeurMonstre = isset($_GET['valeurMonstre']) ? addslashes($_GET['valeurMonstre']) : "";
$isCacher = isset($_GET['isCacher']) ? addslashes($_GET['isCacher']) : "0";
$dossierElements = isset($_GET['dossierElement']) ? addslashes($_GET['dossierElement']) : "";

/**
 * creaction objet requeteurAPI
 */
$requeteurSQL = new requeteurSQL();

/**
 * selection des requetes sql à effectuer
 */
if (!$requeteurSQL->getErreur()){
    switch ($action){
        case "getPersonnage":
            getPersonnage($nomPersonnage, $requeteurSQL);
            break;
        case "getPersonnageID":
            getPersonnageID($IDPersonnage, $requeteurSQL);
            break;
        case "addPersonnage":
            addPersonnage($nomPersonnage, $requeteurSQL);
            break;
        case "deletePersonnage":
            deletePersonnage($IDPersonnage, $requeteurSQL);
            break;
        case "modifierValeurPersonnage":
            modifierValeurPersonnage($IDPersonnage, $champPersonnage, $valeurPersonnage, $requeteurSQL);
            break;
        case "modifierValeurNomPersonnage":
            modifierValeurNomPersonnage($nomPersonnage, $champPersonnage, $valeurPersonnage, $requeteurSQL);
            break;
        case "countMessageMJ":
            countMessageMJ($nomPersonnage, $requeteurSQL);
            break;
        case "countMessageJoueur":
            countMessageJoueur($requeteurSQL);
            break;
        case "getMessages":
            getMessages($nomPersonnage, $requeteurSQL);
            break;
        case "addMessage":
            addMessage($IDPersonnage, $message, $requeteurSQL);
            break;
        case "allMessagesLue":
            allMessagesLue($nomPersonnage, $requeteurSQL);
            break;
        case "allMessagesJoueurLue":
            allMessagesJoueurLue($requeteurSQL);
            break;
        case "getCarte":
            getCarte($requeteurSQL);
            break;
        case "getCarteID":
            getCarteID($idCarte, $requeteurSQL);
            break;
        case "addCarte":
            addCarte($nomCarte, $imageCarte, $requeteurSQL);
            break;
        case "aCacher":
            aCacher($idCarte, $axeHorizontal, $axeVertical, $requeteurSQL);
            break;
        case "afficherCase":
            afficherCase($idCarte, $axeHorizontal, $axeVertical, $requeteurSQL);
            break;
        case "cacherCase":
            cacherCase($idCarte, $axeHorizontal, $axeVertical, $requeteurSQL);
            break;
        case "modifierAxeVertical":
            modifierAxeVertical($idCarte, $axeVertical, $requeteurSQL);
            break;
        case "modifierAxeHorizontal":
            modifierAxeHorizontal($idCarte, $axeHorizontal, $requeteurSQL);
            break;
        case "afficherCarte":
            afficherCarte($idCarte, $requeteurSQL);
            break;
        case "notAfficherCarte":
            notAfficherCarte($requeteurSQL);
            break;
        case "modifierTypeAffichage":
            modifierTypeAffichage($idCarte, $typeAffichage, $requeteurSQL);
            break;
        case "jouerSon":
            jouerSon($cheminSon, $IDPersonnage, $requeteurSQL);
            break;
        case "doitjouerSon":
            doitjouerSon($dateLancementClient, $idSession, $nomPersonnage, $requeteurSQL);
            break;
        case "getBestiaire":
            getBestiaire($isCacher, $requeteurSQL);
            break;
        case "getMonstreID":
            getMonstreID($IDMonstre, $requeteurSQL);
            break;
        case "addMonstre":
            addMonstre($nomMonstre, $requeteurSQL);
            break;
        case "deleteMonstre":
            deleteMonstre($IDMonstre, $requeteurSQL);
            break;
        case "modifierValeurMonstre":
            modifierValeurMonstre($IDMonstre, $champMonstre, $valeurMonstre, $requeteurSQL);
            break;
        case "cacherMonstre":
            cacherMonstre($IDMonstre, $isCacher, $requeteurSQL);
            break;
        case "listingElementsDossier":
            listingElementsDossier($dossierElements);
            break;
    }
}

/**
 * @param $nomPersonnage
 * @param requeteurSQL $requeteurSQL
 */
function getPersonnage($nomPersonnage, $requeteurSQL){
    $unPersonnage = $requeteurSQL->getPersonnage($nomPersonnage);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }else{
        echo json_encode($unPersonnage);
    }
}

/**
 * @param $IDPersonnage
 * @param requeteurSQL $requeteurSQL
 */
function getPersonnageID($IDPersonnage, $requeteurSQL){
    $unPersonnage = $requeteurSQL->getPersonnageID($IDPersonnage);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }else{
        echo json_encode($unPersonnage);
    }
}

/**
 * @param $nomPersonnage
 * @param requeteurSQL $requeteurSQL
 */
function addPersonnage($nomPersonnage, $requeteurSQL){
    $unPersonnage = $requeteurSQL->getPersonnage($nomPersonnage);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }else if (count($unPersonnage) != 0){
        echo "non Personnage deja utilisé";
    }else{
        $requeteurSQL->addPersonnage($nomPersonnage);

        if ($requeteurSQL->getErreur()){
            echo $requeteurSQL->getMessageErreur();
        }else{
            $unPersonnage = $requeteurSQL->getPersonnage($nomPersonnage);

            if ($requeteurSQL->getErreur()){
                echo $requeteurSQL->getMessageErreur();
            }else{
                echo json_encode($unPersonnage);
            }
        }
    }
}

/**
 * @param $IDPersonnage
 * @param requeteurSQL $requeteurSQL
 */
function deletePersonnage($IDPersonnage, $requeteurSQL){
    $requeteurSQL->deletePersonnage($IDPersonnage);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param $IDPersonnage
 * @param $champPersonnage
 * @param $valeurPersonnage
 * @param requeteurSQL $requeteurSQL
 */
function modifierValeurPersonnage($IDPersonnage, $champPersonnage, $valeurPersonnage, $requeteurSQL){
    $requeteurSQL->modifierValeurPersonnage($IDPersonnage, $champPersonnage, $valeurPersonnage);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param $nomPersonnage
 * @param $champPersonnage
 * @param $valeurPersonnage
 * @param requeteurSQL $requeteurSQL
 */
function modifierValeurNomPersonnage($nomPersonnage, $champPersonnage, $valeurPersonnage, $requeteurSQL){
    $requeteurSQL->modifierValeurNomPersonnage($nomPersonnage, $champPersonnage, $valeurPersonnage);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param $nomPersonnage
 * @param requeteurSQL $requeteurSQL
 */
function countMessageMJ($nomPersonnage, $requeteurSQL){
    $nombreMessage = $requeteurSQL->countMessageMJ($nomPersonnage);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }else{
        echo json_encode($nombreMessage);
    }
}

/**
 * @param requeteurSQL $requeteurSQL
 */
function countMessageJoueur($requeteurSQL){
    $nombreMessage = $requeteurSQL->countMessageJoueur();

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }else{
        echo json_encode($nombreMessage);
    }
}

/**
 * @param $nomPersonnage
 * @param requeteurSQL $requeteurSQL
 */
function getMessages($nomPersonnage, $requeteurSQL){
    $listeMessage = $requeteurSQL->getMessages($nomPersonnage);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }else{
        echo json_encode($listeMessage);
    }
}

/**
 * @param $IDPersonnage
 * @param $message
 * @param requeteurSQL $requeteurSQL
 */
function addMessage($IDPersonnage, $message, $requeteurSQL){
    $requeteurSQL->addMessage($IDPersonnage, $message);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param $nomPersonnage
 * @param requeteurSQL $requeteurSQL
 */
function allMessagesLue($nomPersonnage, $requeteurSQL){
    $requeteurSQL->allMessagesLue($nomPersonnage);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param requeteurSQL $requeteurSQL
 */
function allMessagesJoueurLue($requeteurSQL){
    $requeteurSQL->allMessagesJoueurLue();

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param requeteurSQL $requeteurSQL
 */
function getCarte($requeteurSQL){
    $uneCarte = $requeteurSQL->getCarte();

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }else{
        echo json_encode($uneCarte);
    }
}

/**
 * @param $idCarte
 * @param requeteurSQL $requeteurSQL
 */
function getCarteID($idCarte, $requeteurSQL){
    $uneCarte = $requeteurSQL->getCarteID($idCarte);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }else{
        echo json_encode($uneCarte);
    }
}

/**
 * @param $nomCarte
 * @param $imageCarte
 * @param requeteurSQL $requeteurSQL
 */
function addCarte($nomCarte, $imageCarte, $requeteurSQL){
    $uneCarte = $requeteurSQL->getCarteNom($nomCarte);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }else if (count($uneCarte) != 0){
        echo "non Carte deja utilisé";
    }else{
        $requeteurSQL->addCarte($nomCarte, $imageCarte);

        if ($requeteurSQL->getErreur()){
            echo $requeteurSQL->getMessageErreur();
        }else{
            $uneCarte = $requeteurSQL->getCarteNom($nomCarte);

            if ($requeteurSQL->getErreur()){
                echo $requeteurSQL->getMessageErreur();
            }else{
                echo json_encode($uneCarte);
            }
        }
    }
}

/**
 * @param $idCarte
 * @param $axeHorizontal
 * @param $axeVertical
 * @param requeteurSQL $requeteurSQL
 */
function aCacher($idCarte, $axeHorizontal, $axeVertical, $requeteurSQL){
    $uneCaseCarte = array();
    $unBoolean = $requeteurSQL->booleanACacher($idCarte, $axeHorizontal, $axeVertical);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }else{
        $uneCaseCarte['axeHorizontal'] = $axeHorizontal;
        $uneCaseCarte['axeVertical'] = $axeVertical;
        $uneCaseCarte['aCaher'] = $unBoolean;
        echo json_encode($uneCaseCarte);
    }
}

/**
 * @param $idCarte
 * @param $axeHorizontal
 * @param $axeVertical
 * @param requeteurSQL $requeteurSQL
 */
function afficherCase($idCarte, $axeHorizontal, $axeVertical, $requeteurSQL){
    $requeteurSQL->afficherCase($idCarte, $axeHorizontal, $axeVertical);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }else{
        echo "afficher";
    }
}

/**
 * @param $idCarte
 * @param $axeHorizontal
 * @param $axeVertical
 * @param requeteurSQL $requeteurSQL
 */
function cacherCase($idCarte, $axeHorizontal, $axeVertical, $requeteurSQL){
    $requeteurSQL->cacherCase($idCarte, $axeHorizontal, $axeVertical);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }else{
        echo "cacher";
    }
}

/**
 * @param $idCarte
 * @param $axeVertical
 * @param requeteurSQL $requeteurSQL
 */
function modifierAxeVertical($idCarte, $axeVertical, $requeteurSQL){
    $requeteurSQL->modifierAxeVertical($idCarte, $axeVertical);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param $idCarte
 * @param $axeHorizontal
 * @param requeteurSQL $requeteurSQL
 */
function modifierAxeHorizontal($idCarte, $axeHorizontal, $requeteurSQL){
    $requeteurSQL->modifierAxeHorizontal($idCarte, $axeHorizontal);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param $idCarte
 * @param requeteurSQL $requeteurSQL
 */
function afficherCarte($idCarte, $requeteurSQL){
    $requeteurSQL->afficherCarte($idCarte);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param requeteurSQL $requeteurSQL
 */
function notAfficherCarte($requeteurSQL){
    $requeteurSQL->notAfficherCarte();

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param $idCarte
 * @param $typeAffichage
 * @param requeteurSQL $requeteurSQL
 */
function modifierTypeAffichage($idCarte, $typeAffichage, $requeteurSQL){
    $requeteurSQL->modifierTypeAffichage($idCarte, $typeAffichage);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param $cheminSon
 * @param $IDPersonnage
 * @param requeteurSQL $requeteurSQL
 */
function jouerSon($cheminSon, $IDPersonnage, $requeteurSQL){
    $requeteurSQL->jouerSon($cheminSon, $IDPersonnage);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param $dateLancementClient
 * @param $idSession
 * @param $nomPersonnage
 * @param requeteurSQL $requeteurSQL
 */
function doitjouerSon($dateLancementClient, $idSession, $nomPersonnage, $requeteurSQL){
    $cheminSon = $requeteurSQL->doitjouerSon($dateLancementClient, $idSession, $nomPersonnage);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }else{
        echo json_encode($cheminSon);
    }
}

/**
 * @param $isCacher
 * @param requeteurSQL $requeteurSQL
 */
function getBestiaire($isCacher, $requeteurSQL){
    $listBestiaire = $requeteurSQL->getBestiaire($isCacher);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }else{
        echo json_encode($listBestiaire);
    }
}

/**
 * @param $IDMonstre
 * @param requeteurSQL $requeteurSQL
 */
function getMonstreID($IDMonstre, $requeteurSQL){
    $uneMonstre = $requeteurSQL->getMonstreID($IDMonstre);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }else{
        echo json_encode($uneMonstre);
    }
}

/**
 * @param $nomMonstre
 * @param requeteurSQL $requeteurSQL
 */
function addMonstre($nomMonstre, $requeteurSQL){
    $uneMonstre = $requeteurSQL->getMonstreNom($nomMonstre);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }else if (count($uneMonstre) != 0){
        echo "non Monstre deja utilisé";
    }else{
        $requeteurSQL->addMonstre($nomMonstre);

        if ($requeteurSQL->getErreur()){
            echo $requeteurSQL->getMessageErreur();
        }else{
            $uneMonstre = $requeteurSQL->getMonstreNom($nomMonstre);

            if ($requeteurSQL->getErreur()){
                echo $requeteurSQL->getMessageErreur();
            }else{
                echo json_encode($uneMonstre);
            }
        }
    }
}

/**
 * @param $IDMonstre
 * @param requeteurSQL $requeteurSQL
 */
function deleteMonstre($IDMonstre, $requeteurSQL){
    $requeteurSQL->deleteMonstre($IDMonstre);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param $IDMonstre
 * @param $champMonstre
 * @param $valeurMonstre
 * @param requeteurSQL $requeteurSQL
 */
function modifierValeurMonstre($IDMonstre, $champMonstre, $valeurMonstre, $requeteurSQL){
    $requeteurSQL->modifierValeurMonstre($IDMonstre, $champMonstre, $valeurMonstre);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param $IDMonstre
 * @param $isCacher
 * @param requeteurSQL $requeteurSQL
 */
function cacherMonstre($IDMonstre, $isCacher, $requeteurSQL){
    $requeteurSQL->cacherMonstre($IDMonstre, $isCacher);

    if ($requeteurSQL->getErreur()){
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param $dossierElements
 */
function listingElementsDossier($dossierElements){
    $listeElements = array();

    $leDossier = @opendir($dossierElements);
    if ($leDossier !== false){
        while (false !== ($unElement = readdir($leDossier))){
            if ($unElement != "." && $unElement != ".." && !is_dir($unElement)){
                $listeElements[] = $unElement;
            }
        }

        $jSonElemnts = json_encode($listeElements);
        if (!$jSonElemnts) echo "probleme d'encodage du json dossier '".$dossierElements."'";
        else echo $jSonElemnts;
    }else{
        echo "probleme d'ouverture du dossier '".$dossierElements."'";
    }

    @closedir($dossierElements);
}

?>