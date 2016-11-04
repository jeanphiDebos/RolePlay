<?php
require_once("./PDOBDD.php");
require_once("./requeteurSQL.php");

/**
 * parametres d'entrer du model
 */
$action = isset($_GET['action']) ? addslashes($_GET['action']) : "";
$table = isset($_GET['table']) ? addslashes($_GET['table']) : "";
$id = isset($_GET['id']) ? addslashes($_GET['id']) : "";
$champ = isset($_GET['champ']) ? addslashes($_GET['champ']) : "";
$valeur = isset($_GET['valeur']) ? addslashes($_GET['valeur']) : "";
$champWhere = isset($_GET['champWhere']) ? addslashes($_GET['champWhere']) : "";
$valeurWhere = isset($_GET['valeurWhere']) ? addslashes($_GET['valeurWhere']) : "";
$champValeur = isset($_GET['champValeur']) ? addslashes($_GET['champValeur']) : "";
$order = isset($_GET['order']) ? addslashes($_GET['order']) : "";

$message = isset($_GET['message']) ? addslashes($_GET['message']) : "";
$axeVertical = isset($_GET['axeVertical']) ? addslashes($_GET['axeVertical']) : "";
$axeHorizontal = isset($_GET['axeHorizontal']) ? addslashes($_GET['axeHorizontal']) : "";
$cheminSon = isset($_GET['cheminSon']) ? addslashes($_GET['cheminSon']) : "";
$dateLancementClient = isset($_GET['dateLancementClient']) ? addslashes($_GET['dateLancementClient']) : "";
$idSession = isset($_GET['idSession']) ? addslashes($_GET['idSession']) : "";
$dossierElements = isset($_GET['dossierElement']) ? addslashes($_GET['dossierElement']) : "";

/**
 * creaction objet requeteurAPI
 */
$requeteurSQL = new requeteurSQL();

/**
 * selection des requetes sql à effectuer
 */
if (!$requeteurSQL->getErreur()) {
    switch ($action) {
        case "getDonneeById":
            getDonneeById($table, $id, $order, $requeteurSQL);
            break;
        case "getDonneeByChamp":
            getDonneeByChamp($table, $champWhere, $valeurWhere, $order, $requeteurSQL);
            break;
        case "getDonneesById":
            getDonneesById($table, $id, $order, $requeteurSQL);
            break;
        case "getDonneesByChamp":
            getDonneesByChamp($table, $champWhere, $valeurWhere, $order, $requeteurSQL);
            break;
        case "getDonnees":
            getDonnees($table, $order, $requeteurSQL);
            break;
        case "insertValeur":
            insertValeur($table, $champ, $valeur, $requeteurSQL);
            break;
        case "insertValeurMultiple":
            insertValeurMultiple($table, $champValeur, $requeteurSQL);
            break;
        case "deleteDonneeById":
            deleteDonneeById($table, $id, $requeteurSQL);
            break;
        case "deleteDonneeByChamp":
            deleteDonneeByChamp($table, $champWhere, $valeurWhere, $requeteurSQL);
            break;
        case "updateValeurDonnee":
            updateValeurDonnee($table, $id, $champ, $valeur, $requeteurSQL);
            break;
        case "updateValeurDonneeByChamp":
            updateValeurDonneeByChamp($table, $champ, $valeur, $champWhere, $valeurWhere, $requeteurSQL);
            break;
        case "addDonneeByValeur":
            addDonneeByValeur($table, $champ, $valeur, $order, $requeteurSQL);
            break;
        case "countMessageMJ":
            countMessageMJ($valeur, $requeteurSQL);
            break;
        case "countMessageJoueur":
            countMessageJoueur($requeteurSQL);
            break;
        case "getMessages":
            getMessages($valeur, $requeteurSQL);
            break;
        case "addMessage":
            addMessage($id, $message, $requeteurSQL);
            break;
        case "allMessagesLue":
            allMessagesLue($valeur, $requeteurSQL);
            break;
        case "allMessagesJoueurLue":
            allMessagesJoueurLue($requeteurSQL);
            break;
        case "aCacher":
            aCacher($id, $axeHorizontal, $axeVertical, $requeteurSQL);
            break;
        case "afficherCase":
            afficherCase($id, $axeHorizontal, $axeVertical, $requeteurSQL);
            break;
        case "cacherCase":
            cacherCase($id, $axeHorizontal, $axeVertical, $requeteurSQL);
            break;
        case "jouerSon":
            jouerSon($cheminSon, $id, $requeteurSQL);
            break;
        case "doitjouerSon":
            doitjouerSon($dateLancementClient, $idSession, $valeur, $requeteurSQL);
            break;
        case "listingElementsDossier":
            listingElementsDossier($dossierElements);
            break;
    }
} else {
    echo $requeteurSQL->getMessageErreur();
}

/**
 * @param string $table
 * @param string $id
 * @param string $order
 * @param requeteurSQL $requeteurSQL
 */
function getDonneeById($table, $id, $order, $requeteurSQL)
{
    $donnee = $requeteurSQL->getDonneeById($table, $id, $order);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    } else {
        echo json_encode($donnee);
    }
}

/**
 * @param string $table
 * @param string $champWhere
 * @param string $valeurWhere
 * @param string $order
 * @param requeteurSQL $requeteurSQL
 */
function getDonneeByChamp($table, $champWhere, $valeurWhere, $order, $requeteurSQL)
{
    $donnee = $requeteurSQL->getDonneeByChamp($table, $champWhere, $valeurWhere, $order);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    } else {
        echo json_encode($donnee);
    }
}

/**
 * @param string $table
 * @param string $id
 * @param string $order
 * @param requeteurSQL $requeteurSQL
 */
function getDonneesById($table, $id, $order, $requeteurSQL)
{
    $donnees = $requeteurSQL->getDonneesById($table, $id, $order);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    } else {
        echo json_encode($donnees);
    }
}

/**
 * @param string $table
 * @param string $champWhere
 * @param string $valeurWhere
 * @param string $order
 * @param requeteurSQL $requeteurSQL
 */
function getDonneesByChamp($table, $champWhere, $valeurWhere, $order, $requeteurSQL)
{
    $donnees = $requeteurSQL->getDonneesByChamp($table, $champWhere, $valeurWhere, $order);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    } else {
        echo json_encode($donnees);
    }
}

/**
 * @param string $table
 * @param string $order
 * @param requeteurSQL $requeteurSQL
 */
function getDonnees($table, $order, $requeteurSQL)
{
    $donnees = $requeteurSQL->getDonnees($table, $order);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    } else {
        echo json_encode($donnees);
    }
}

/**
 * @param string $table
 * @param string $champ
 * @param string $valeur
 * @param requeteurSQL $requeteurSQL
 */
function insertValeur($table, $champ, $valeur, $requeteurSQL)
{
    $requeteurSQL->insertValeur($table, $champ, $valeur);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param string $table
 * @param string $champValeur
 * @param requeteurSQL $requeteurSQL
 */
function insertValeurMultiple($table, $champValeur, $requeteurSQL)
{
    $requeteurSQL->insertValeurMultiple($table, $champValeur);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param string $table
 * @param string $id
 * @param requeteurSQL $requeteurSQL
 */
function deleteDonneeById($table, $id, $requeteurSQL)
{
    $requeteurSQL->deleteDonneeById($table, $id);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param string $table
 * @param string $champWhere
 * @param string $valeurWhere
 * @param requeteurSQL $requeteurSQL
 */
function deleteDonneeByChamp($table, $champWhere, $valeurWhere, $requeteurSQL)
{
    $requeteurSQL->deleteDonneeByChamp($table, $champWhere, $valeurWhere);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param string $table
 * @param string $id
 * @param string $champ
 * @param string $valeur
 * @param requeteurSQL $requeteurSQL
 */
function updateValeurDonnee($table, $id, $champ, $valeur, $requeteurSQL)
{
    $requeteurSQL->updateValeurDonnee($table, $id, $champ, $valeur);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param string $table
 * @param string $champ
 * @param string $valeur
 * @param string $champWhere
 * @param string $valeurWhere
 * @param requeteurSQL $requeteurSQL
 */
function updateValeurDonneeByChamp($table, $champ, $valeur, $champWhere, $valeurWhere, $requeteurSQL)
{
    $requeteurSQL->updateValeurDonneeByChamp($table, $champ, $valeur, $champWhere, $valeurWhere);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param string $table
 * @param string $champ
 * @param string $valeur
 * @param string $order
 * @param requeteurSQL $requeteurSQL
 */
function addDonneeByValeur($table, $champ, $valeur, $order, $requeteurSQL)
{
    $donnee = $requeteurSQL->getDonneeByChamp($table, $champ, $valeur, $order);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    } else if (count($donnee) != 0) {
        echo "donnée deja utilisé";
    } else {
        $requeteurSQL->insertValeur($table, $champ, $valeur);

        if ($requeteurSQL->getErreur()) {
            echo $requeteurSQL->getMessageErreur();
        } else {
            $donnee = $requeteurSQL->getDonneeByChamp($table, $champ, $valeur, $order);

            if ($requeteurSQL->getErreur()) {
                echo $requeteurSQL->getMessageErreur();
            } else {
                echo json_encode($donnee);
            }
        }
    }
}

/**
 * @param string $nomPersonnage
 * @param requeteurSQL $requeteurSQL
 */
function countMessageMJ($nomPersonnage, $requeteurSQL)
{
    $nombreMessage = $requeteurSQL->countMessageMJ($nomPersonnage);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    } else {
        echo json_encode($nombreMessage);
    }
}

/**
 * @param requeteurSQL $requeteurSQL
 */
function countMessageJoueur($requeteurSQL)
{
    $nombreMessage = $requeteurSQL->countMessageJoueur();

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    } else {
        echo json_encode($nombreMessage);
    }
}

/**
 * @param string $nomPersonnage
 * @param requeteurSQL $requeteurSQL
 */
function getMessages($nomPersonnage, $requeteurSQL)
{
    $listeMessage = $requeteurSQL->getMessages($nomPersonnage);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    } else {
        echo json_encode($listeMessage);
    }
}

/**
 * @param string $IDPersonnage
 * @param string $message
 * @param requeteurSQL $requeteurSQL
 */
function addMessage($IDPersonnage, $message, $requeteurSQL)
{
    $requeteurSQL->addMessage($IDPersonnage, $message);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param string $nomPersonnage
 * @param requeteurSQL $requeteurSQL
 */
function allMessagesLue($nomPersonnage, $requeteurSQL)
{
    $donnee = $requeteurSQL->getDonneeByChamp("personnage", "nom", $nomPersonnage);
    if ($donnee['id']) {
        $requeteurSQL->allMessagesLue($donnee['id']);

        if ($requeteurSQL->getErreur()) {
            echo $requeteurSQL->getMessageErreur();
        }
    }
}

/**
 * @param requeteurSQL $requeteurSQL
 */
function allMessagesJoueurLue($requeteurSQL)
{
    $requeteurSQL->allMessagesLue(0);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param $idCarte
 * @param $axeHorizontal
 * @param $axeVertical
 * @param requeteurSQL $requeteurSQL
 */
function aCacher($idCarte, $axeHorizontal, $axeVertical, $requeteurSQL)
{
    $uneCaseCarte = array();
    $unBoolean = $requeteurSQL->booleanACacher($idCarte, $axeHorizontal, $axeVertical);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    } else {
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
function afficherCase($idCarte, $axeHorizontal, $axeVertical, $requeteurSQL)
{
    $requeteurSQL->afficherCase($idCarte, $axeHorizontal, $axeVertical);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    } else {
        echo "afficher";
    }
}

/**
 * @param $idCarte
 * @param $axeHorizontal
 * @param $axeVertical
 * @param requeteurSQL $requeteurSQL
 */
function cacherCase($idCarte, $axeHorizontal, $axeVertical, $requeteurSQL)
{
    $requeteurSQL->cacherCase($idCarte, $axeHorizontal, $axeVertical);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    } else {
        echo "cacher";
    }
}

/**
 * @param $cheminSon
 * @param $IDPersonnage
 * @param requeteurSQL $requeteurSQL
 */
function jouerSon($cheminSon, $IDPersonnage, $requeteurSQL)
{
    $requeteurSQL->jouerSon($cheminSon, $IDPersonnage);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    }
}

/**
 * @param $dateLancementClient
 * @param $idSession
 * @param $nomPersonnage
 * @param requeteurSQL $requeteurSQL
 */
function doitjouerSon($dateLancementClient, $idSession, $nomPersonnage, $requeteurSQL)
{
    $cheminSon = $requeteurSQL->doitjouerSon($dateLancementClient, $idSession, $nomPersonnage);

    if ($requeteurSQL->getErreur()) {
        echo $requeteurSQL->getMessageErreur();
    } else {
        echo json_encode($cheminSon);
    }
}

/**
 * @param $dossierElements
 */
function listingElementsDossier($dossierElements)
{
    $listeElements = array();

    $leDossier = @opendir($dossierElements);
    if ($leDossier !== false) {
        while (false !== ($unElement = readdir($leDossier))) {
            if ($unElement != "." && $unElement != ".." && !is_dir($unElement)) {
                $listeElements[] = $unElement;
            }
        }

        $jSonElemnts = json_encode($listeElements);
        if (!$jSonElemnts) echo "probleme d'encodage du json dossier '" . $dossierElements . "'";
        else echo $jSonElemnts;
    } else {
        echo "probleme d'ouverture du dossier '" . $dossierElements . "'";
    }

    @closedir($dossierElements);
}

?>