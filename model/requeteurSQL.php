<?php

/**
 * Class requeteurSQL
 */
class requeteurSQL
{
    /**
     * @var bool
     */
    private $erreur;
    /**
     * @var string
     */
    private $MessageErreur;
    /**
     * @var string
     */
    private $separateur;
    /**
     * @var PDOBDD
     */
    private $PDOBDD;

    /**
     * requeteurSQL constructor.
     */
    public function __construct()
    {
        $this->separateur = "<br>";
        $this->PDOBDD = new PDOBDD("localhost", "role_play", "role_play", "");
        if ($this->PDOBDD->getErrorConnection()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur PDO : " . $this->PDOBDD->getMessageError();
        }
    }

    /**
     * @return bool
     */
    public function getErreur()
    {
        if ($this->erreur) return true;
        else return false;
    }

    /**
     * @return string
     */
    public function getMessageErreur()
    {
        return $this->MessageErreur;
    }

    /**
     * @param string $table
     * @param string $id
     * @param string $order
     * @return array
     */
    public function getDonneeById($table, $id, $order)
    {
        $requete = "SELECT * FROM `" . $table . "` WHERE `id` like '" . $id . "'" . $order;

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getDonneeById, " . $this->PDOBDD->getMessageError();

            return array();
        } else if (count($result) != 0) {
            return $result[0];
        } else {
            return array();
        }
    }

    /**
     * @param string $table
     * @param string $champ
     * @param string $valeur
     * @param string $order
     * @return array
     */
    public function getDonneeByChamp($table, $champ, $valeur, $order = "")
    {
        $requete = "SELECT * FROM `" . $table . "` WHERE `" . $champ . "` like '" . addslashes($valeur) . "'" . $order;

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getDonneeByChamp, " . $this->PDOBDD->getMessageError();

            return array();
        } else if (count($result) != 0) {
            return $result[0];
        } else {
            return array();
        }
    }

    /**
     * @param string $table
     * @param string $id
     * @param string $order
     * @return array
     */
    public function getDonneesById($table, $id, $order)
    {
        $requete = "SELECT * FROM `" . $table . "` WHERE `id` like '" . $id . "'" . $order;

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getDonneesById, " . $this->PDOBDD->getMessageError();

            return array();
        } else {
            return $result;
        }
    }

    /**
     * @param string $table
     * @param string $champ
     * @param string $valeur
     * @param string $order
     * @return array
     */
    public function getDonneesByChamp($table, $champ, $valeur, $order)
    {
        $requete = "SELECT * FROM `" . $table . "` WHERE `" . $champ . "` like '" . addslashes($valeur) . "'" . $order;

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getDonneesByChamp, " . $this->PDOBDD->getMessageError();

            return array();
        } else {
            return $result;
        }
    }

    /**
     * @param string $table
     * @param string $order
     * @return array
     */
    public function getDonnees($table, $order)
    {
        $requete = "SELECT * FROM `" . $table . "`" . $order;

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getDonnees, " . $this->PDOBDD->getMessageError();

            return array();
        } else if (count($result) != 0) {
            return $result;
        } else {
            return array();
        }
    }

    /**
     * @param string $table
     * @param string $champ
     * @param string $valeur
     */
    public function insertValeur($table, $champ, $valeur)
    {
        $requete = "INSERT INTO `" . $table . "`(`" . $champ . "`) VALUES ('" . addslashes($valeur) . "')";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur insertValeur, " . $this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param string $table
     * @param string $champValeur
     */
    public function insertValeurMultiple($table, $champValeur)
    {
        $requete = "INSERT INTO `" . $table . "`(";
        for ($i = 0; $i < count($champValeur['champ']); $i++) {
            $requete .= "`" . $champValeur['champ'][$i] . "`";
            if ($i < count($champValeur['champ']) - 1) $requete .= ", ";
            else $requete .= ") VALUES (";
        }
        for ($i = 0; $i < count($champValeur['valeur']); $i++) {
            $requete .= "'" . addslashes($champValeur['valeur'][$i]) . "'";
            if ($i < count($champValeur['valeur']) - 1) $requete .= ",";
            else $requete .= ")";
        }

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur insertValeur, " . $this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param string $table
     * @param string $id
     */
    public function deleteDonneeById($table, $id)
    {
        $requete = "DELETE FROM `" . $table . "` WHERE `id` = '" . $id . "'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur deleteDonneeById, " . $this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param string $table
     * @param string $champ
     * @param string $valeur
     */
    public function deleteDonneeByChamp($table, $champ, $valeur)
    {
        $requete = "DELETE FROM `" . $table . "` WHERE `" . $champ . "` = '" . addslashes($valeur) . "'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur deleteDonneeById, " . $this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param string $table
     * @param string $id
     * @param string $champ
     * @param string $valeur
     */
    public function updateValeurDonnee($table, $id, $champ, $valeur)
    {
        $requete = "UPDATE `" . $table . "` SET `" . $champ . "` = '" . addslashes($valeur) . "' WHERE `id` = '" . $id . "'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur updateValeurDonnee, " . $this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param string $table
     * @param string $champ
     * @param string $valeur
     * @param string $champWhere
     * @param string $valeurWhere
     */
    public function updateValeurDonneeByChamp($table, $champ, $valeur, $champWhere, $valeurWhere)
    {
        $requete = "UPDATE `" . $table . "` SET `" . $champ . "` = '" . addslashes($valeur) . "' WHERE `" . $champWhere . "` like '" . addslashes($valeurWhere) . "'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur updateValeurDonneeByChamp, " . $this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param string $nomPersonnage
     * @return array
     */
    public function countMessageMJ($nomPersonnage)
    {
        $requete = "SELECT count(*) AS `nombreMessage` FROM `personnage` INNER JOIN `message` ON `personnage`.`id`=`message`.`idPerso` WHERE `nom` like '" . $nomPersonnage . "' AND `lue` like 'non'";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur countMessageMJ, " . $this->PDOBDD->getMessageError();

            return array();
        } else if (count($result) != 0) {
            return $result[0];
        } else {
            $result['nombreMessage'] = 0;

            return $result;
        }
    }

    /**
     * @return array
     */
    public function countMessageJoueur()
    {
        $requete = "SELECT count(*) AS `nombreMessage` FROM `message` WHERE `idPerso` like '0' AND `lue` like 'non'";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur countMessageJoueur, " . $this->PDOBDD->getMessageError();

            return array();
        } else if (count($result) != 0) {
            return $result[0];
        } else {
            $result['nombreMessage'] = 0;

            return $result;
        }
    }

    /**
     * @param string $nomPersonnage
     * @return array
     */
    public function getMessages($nomPersonnage)
    {
        $requete = "SELECT * FROM `personnage` INNER JOIN `message` ON `personnage`.`id`=`message`.`idPerso` WHERE `nom` like '" . $nomPersonnage . "' ORDER BY `message`.`id` ASC";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getMessages, " . $this->PDOBDD->getMessageError();

            return array();
        } else {
            return $result;
        }
    }

    /**
     * @param string $IDPersonnage
     * @param string $message
     */
    public function addMessage($IDPersonnage, $message)
    {
        $requete = "INSERT INTO `message` (`idPerso` ,`message` ,`lue`, `dateCreaction`) VALUES ('" . $IDPersonnage . "', '" . $message . "', 'non', NOW())";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur addMessage, " . $this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param string $IDPersonnage
     */
    public function allMessagesLue($IDPersonnage)
    {
        $requete = "UPDATE message SET lue = 'oui' WHERE `idPerso` like '" . $IDPersonnage . "' AND lue = 'non'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur allMessagesLue, " . $this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param string $idCarte
     * @param string $axeHorizontal
     * @param string $axeVertical
     * @return bool
     */
    public function booleanACacher($idCarte, $axeHorizontal, $axeVertical)
    {
        $requete = "SELECT * FROM `mappagecarte` WHERE `idCarte` like '" . $idCarte . "' AND`axeVertical` like '" . $axeVertical . "' AND `axeHorizontal` like '" . $axeHorizontal . "'";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur booleanACacher, " . $this->PDOBDD->getMessageError();

            return true;
        } else {
            if (count($result) != 0) return false;
            else return true;
        }
    }

    /**
     * @param string $idCarte
     * @param string $axeHorizontal
     * @param string $axeVertical
     */
    public function cacherCase($idCarte, $axeHorizontal, $axeVertical)
    {
        $requete = "DELETE FROM `mappagecarte` WHERE `idCarte` like '" . $idCarte . "' AND `axeHorizontal` like '" . $axeHorizontal . "' AND `axeVertical` like '" . $axeVertical . "'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur cacherCase, " . $this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param string $idCarte
     * @param string $axeHorizontal
     * @param string $axeVertical
     */
    public function afficherCase($idCarte, $axeHorizontal, $axeVertical)
    {
        $requete = "INSERT INTO `mappagecarte` (`idCarte` ,`axeHorizontal` ,`axeVertical`) VALUES ('" . $idCarte . "', '" . $axeHorizontal . "', '" . $axeVertical . "') ON DUPLICATE KEY UPDATE `idCarte`='" . $idCarte . "'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur afficherCase, " . $this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param string $cheminSon
     * @param string $IDPersonnage
     */
    public function jouerSon($cheminSon, $IDPersonnage)
    {
        if ($IDPersonnage == "") $IDPersonnage = "NULL";
        $requete = "INSERT INTO `sonajouer` (dateTime, cheminSon, idPerso) VALUES (NOW(), '" . $cheminSon . "', " . $IDPersonnage . ")";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur jouerSon, " . $this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param string $dateLancementClient
     * @param string $idSession
     * @param string $idPerso
     * @return string
     */
    public function doitjouerSon($dateLancementClient, $idSession, $idPerso)
    {
        $requete = "SELECT * FROM `sonajouer` WHERE `dateTime` >= '" . $dateLancementClient . "' AND `id` NOT IN (SELECT `idSon` FROM `historisationsonjouer` WHERE `idSession` = '" . $idSession . "') AND (`idPerso` IS NULL OR `idPerso` = '" . $idPerso . "')";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur doitjouerSon, " . $this->PDOBDD->getMessageError();
        } else {
            if (isset($result[0])) {
                $requete = "INSERT INTO `historisationsonjouer` (idSon, idSession) VALUES (" . $result[0]['id'] . ", '" . $idSession . "')";

                $this->PDOBDD->ExecuterRequeteNoReturn($requete);
                if ($this->PDOBDD->getErrorRequete()) {
                    $this->erreur = true;
                    $this->MessageErreur = "erreur sur doitjouerSon, " . $this->PDOBDD->getMessageError();
                }
                return $result[0]['cheminSon'];
            }
        }
        return "";
    }

    /**
     * @param string $animation
     * @param string $pourQui
     */
    public function insertAnimation($animation, $pourQui)
    {
        $requete = "INSERT INTO `evenanimation` (dateTime, animation, pourQui) VALUES (NOW(), '" . $animation . "', '" . $pourQui . "')";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur insertAnimation, " . $this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param string $dateLancementClient
     * @return array
     */
    public function getEvenAnimation($dateLancementClient)
    {
        $requete = "SELECT * FROM `evenanimation` WHERE `dateTime` >= '" . $dateLancementClient . "' AND `jouer` = 'non'";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()) {
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getEvenAnimation, " . $this->PDOBDD->getMessageError();

            return array();
        } else if (count($result) != 0) {
            return $result;
        } else {
            return array();
        }
    }

    /**
     *
     */
    public function __destruct()
    {

    }
}

?>
