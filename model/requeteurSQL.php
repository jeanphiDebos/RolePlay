<?php

/**
 * Class requeteurSQL
 */
class requeteurSQL{
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
    public function __construct(){
        $this->separateur = "<br>";
        $this->PDOBDD = new PDOBDD("localhost", "role_play", "Nashi_Dev", "marchen35610");
        if ($this->PDOBDD->getErrorConnection()){
            $this->erreur = true;
            $this->MessageErreur = "erreur PDO : ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @return bool
     */
    public function getErreur(){
        if ($this->erreur) return true;
        else return false;
    }

    /**
     * @return string
     */
    public function getMessageErreur(){
        return $this->MessageErreur;
    }

    /**
     * @param $IDPersonnage
     * @return array
     */
    public function getPersonnageID($IDPersonnage){
        $requete = "SELECT * FROM `personnage` WHERE `id` like '".$IDPersonnage."'";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getPersonnageID, ".$this->PDOBDD->getMessageError();

            return array();
        }else if (count($result) != 0){
            return $result[0];
        }else{
            return array();
        }
    }

    /**
     * @return array|string
     */
    public function getListePersonnages(){
        $requete = "SELECT * FROM `personnage`";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getListePersonnages, ".$this->PDOBDD->getMessageError();

            return array();
        }else if (count($result) != 0){
            return $result;
        }else{
            return array();
        }
    }

    /**
     * @param $nomPersonnage
     */
    public function addPersonnage($nomPersonnage){
        $requete = "INSERT INTO `personnage` (`nom`) VALUES ('".$nomPersonnage."')";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur addPersonnage, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param $IDPersonnage
     */
    public function deletePersonnage($IDPersonnage){
        $requete = "DELETE FROM `personnage` WHERE `id` = '".$IDPersonnage."'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur deletePersonnage, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param $IDPersonnage
     * @param $champPersonnage
     * @param $valeurPersonnage
     */
    public function modifierValeurPersonnage($IDPersonnage, $champPersonnage, $valeurPersonnage){
        $requete = "UPDATE `personnage` SET `".$champPersonnage."` = '".$valeurPersonnage."' WHERE `id` = '".$IDPersonnage."'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur modifierValeurPersonnage, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param $nomPersonnage
     * @param $champPersonnage
     * @param $valeurPersonnage
     */
    public function modifierValeurNomPersonnage($nomPersonnage, $champPersonnage, $valeurPersonnage){
        $requete = "UPDATE `personnage` SET `".$champPersonnage."` = '".$valeurPersonnage."' WHERE `nom` like '".$nomPersonnage."'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur modifierValeurNomPersonnage, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param $nomPersonnage
     * @return array|string
     */
    public function countMessageMJ($nomPersonnage){
        $requete = "SELECT count(*) AS `nombreMessage` FROM `personnage` INNER JOIN `message` ON `personnage`.`id`=`message`.`idPerso` WHERE `nom` like '".$nomPersonnage."' AND `lue` like 'non'";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur countMessageMJ, ".$this->PDOBDD->getMessageError();

            return array();
        }else if (count($result) != 0){
            return $result[0];
        }else{
            $result['nombreMessage'] = 0;

            return $result;
        }
    }

    /**
     * @return array|string
     */
    public function countMessageJoueur(){
        $requete = "SELECT count(*) AS `nombreMessage` FROM `message` WHERE `idPerso` like '0' AND `lue` like 'non'";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur countMessageJoueur, ".$this->PDOBDD->getMessageError();

            return array();
        }else if (count($result) != 0){
            return $result[0];
        }else{
            $result['nombreMessage'] = 0;

            return $result;
        }
    }

    /**
     * @param $nomPersonnage
     * @return array|string
     */
    public function getMessages($nomPersonnage){
        $personnage = $this->getPersonnage($nomPersonnage);
        $requete = "SELECT * FROM `message` WHERE `idPerso` like '".$personnage['id']."' ORDER BY `id` ASC";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getMessages, ".$this->PDOBDD->getMessageError();

            return array();
        }else{
            return $result;
        }
    }

    /**
     * @param $nomPersonnage
     * @return array
     */
    public function getPersonnage($nomPersonnage){
        $requete = "SELECT * FROM `personnage` WHERE `nom` like '".$nomPersonnage."'";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getPersonnage, ".$this->PDOBDD->getMessageError();

            return array();
        }else if (count($result) != 0){
            return $result[0];
        }else{
            return array();
        }
    }

    /**
     * @return array|string
     */
    public function getMessagesJoueurs(){
        $requete = "SELECT * FROM `message` WHERE `idPerso` like '0' ORDER BY `id` ASC";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getMessages, ".$this->PDOBDD->getMessageError();

            return array();
        }else{
            return $result;
        }
    }

    /**
     * @param $IDPersonnage
     * @param $message
     */
    public function addMessage($IDPersonnage, $message){
        $requete = "INSERT INTO `message` (`idPerso` ,`message` ,`lue`, `dateCreaction`) VALUES ('".$IDPersonnage."', '".$message."', 'non', NOW())";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur addMessage, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param $nomPersonnage
     */
    public function allMessagesLue($nomPersonnage){
        $personnage = $this->getPersonnage($nomPersonnage);
        $requete = "UPDATE message SET lue = 'oui' WHERE `idPerso` like '".$personnage['id']."' AND lue = 'non'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur allMessagesLue, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     *
     */
    public function allMessagesJoueurLue(){
        $requete = "UPDATE message SET lue = 'oui' WHERE `idPerso` like '0' AND lue = 'non'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur allMessagesJoueurLue, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param $idCarte
     * @return array
     */
    public function getCarteID($idCarte){
        $requete = "SELECT * FROM `carte` WHERE `id` like '".$idCarte."'";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getCarteID, ".$this->PDOBDD->getMessageError();

            return array();
        }else if (count($result) != 0){
            return $result[0];
        }else{
            return array();
        }
    }

    /**
     * @param $nomCarte
     * @return array
     */
    public function getCarteNom($nomCarte){
        $requete = "SELECT * FROM `carte` WHERE `nom` like '".$nomCarte."'";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getCarteNom, ".$this->PDOBDD->getMessageError();

            return array();
        }else if (count($result) != 0){
            return $result[0];
        }else{
            return array();
        }
    }

    /**
     * @param $nomCarte
     * @param $imageCarte
     */
    public function addCarte($nomCarte, $imageCarte){
        $requete = "INSERT INTO `carte` (`nom`, `image`) VALUES ('".$nomCarte."', '".$imageCarte."')";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur addCarte, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @return array
     */
    public function getCarte(){
        $requete = "SELECT * FROM `carte` WHERE `afficher` like 'oui'";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getCarte, ".$this->PDOBDD->getMessageError();

            return array();
        }else if (count($result) != 0){
            return $result[0];
        }else{
            return array();
        }
    }

    /**
     * @return array|string
     */
    public function getListeCartes(){
        $requete = "SELECT * FROM `carte`";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getListeCartes, ".$this->PDOBDD->getMessageError();

            return array();
        }else if (count($result) != 0){
            return $result;
        }else{
            return array();
        }
    }

    /**
     * @param $idCarte
     * @param $axeHorizontal
     * @param $axeVertical
     * @return array|bool
     */
    public function booleanACacher($idCarte, $axeHorizontal, $axeVertical){
        $requete = "SELECT * FROM `mappagecarte` WHERE `idCarte` like '".$idCarte."' AND`axeVertical` like '".$axeVertical."' AND `axeHorizontal` like '".$axeHorizontal."'";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur booleanACacher, ".$this->PDOBDD->getMessageError();

            return array();
        }else{
            if (count($result) != 0) return false;
            else return true;
        }
    }

    /**
     * @param $idCarte
     * @param $axeHorizontal
     * @param $axeVertical
     */
    public function cacherCase($idCarte, $axeHorizontal, $axeVertical){
        $requete = "DELETE FROM `mappagecarte` WHERE `idCarte` like '".$idCarte."' AND `axeHorizontal` like '".$axeHorizontal."' AND `axeVertical` like '".$axeVertical."'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur cacherCase, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param $idCarte
     * @param $axeHorizontal
     * @param $axeVertical
     */
    public function afficherCase($idCarte, $axeHorizontal, $axeVertical){
        $requete = "INSERT INTO `mappagecarte` (`idCarte` ,`axeHorizontal` ,`axeVertical`) VALUES ('".$idCarte."', '".$axeHorizontal."', '".$axeVertical."') ON DUPLICATE KEY UPDATE `idCarte`='".$idCarte."'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur afficherCase, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param $idCarte
     * @param $axeVertical
     */
    public function modifierAxeVertical($idCarte, $axeVertical){
        $requete = "UPDATE `carte` SET `axeVertical` = '".$axeVertical."' WHERE `id` = '".$idCarte."'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur modifierAxeVertical, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param $idCarte
     * @param $axeHorizontal
     */
    public function modifierAxeHorizontal($idCarte, $axeHorizontal){
        $requete = "UPDATE `carte` SET `axeHorizontal` = '".$axeHorizontal."' WHERE `id` = '".$idCarte."'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur modifierAxeHorizontal, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param $idCarte
     */
    public function afficherCarte($idCarte){
        $this->notAfficherCarte();
        if (!$this->PDOBDD->getErrorRequete()){
            $requete = "UPDATE `carte` SET `afficher` = 'oui' WHERE `id` = '".$idCarte."'";

            $this->PDOBDD->ExecuterRequeteNoReturn($requete);
            if ($this->PDOBDD->getErrorRequete()){
                $this->erreur = true;
                $this->MessageErreur = "erreur sur afficherCarte, ".$this->PDOBDD->getMessageError();
            }
        }
    }

    /**
     *
     */
    public function notAfficherCarte(){
        $requete = "UPDATE `carte` SET `afficher` = 'non' WHERE `afficher` like 'oui'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur notAfficherCarte, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param $idCarte
     * @param $typeAffichage
     */
    public function modifierTypeAffichage($idCarte, $typeAffichage){
        $requete = "UPDATE `carte` SET `typeAffichage` = '".$typeAffichage."' WHERE `id` = '".$idCarte."'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur modifierTypeAffichage, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param $cheminSon
     * @param $IDPersonnage
     */
    public function jouerSon($cheminSon, $IDPersonnage){
        if ($IDPersonnage == "") $IDPersonnage = "NULL";
        $requete = "INSERT INTO `sonajouer` (dateTime, cheminSon,idPerso) VALUES (NOW(), '".$cheminSon."', ".$IDPersonnage.")";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur jouerSon, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param $dateLancementClient
     * @param $idSession
     * @param $nomPersonnage
     * @return string
     */
    public function doitjouerSon($dateLancementClient, $idSession, $nomPersonnage){
        $personnage = $this->getPersonnage($nomPersonnage);

        if (empty($personnage['id'])) $idPerso = "`idPerso` IS NULL";
        else $idPerso = "`idPerso` = ".$personnage['id'];

        $requete = "SELECT * FROM `sonajouer` WHERE `dateTime` >= '".$dateLancementClient."' AND `id` NOT IN (SELECT `idSon` FROM `historisationsonjouer` WHERE `idSession` = '".$idSession."') AND (`idPerso` IS NULL OR ".$idPerso.")";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur doitjouerSon, ".$this->PDOBDD->getMessageError();
        }else{
            if (isset($result[0])){
                $requete = "INSERT INTO `historisationsonjouer` (idSon, idSession) VALUES (".$result[0]['id'].", '".$idSession."')";

                $this->PDOBDD->ExecuterRequeteNoReturn($requete);
                if ($this->PDOBDD->getErrorRequete()){
                    $this->erreur = true;
                    $this->MessageErreur = "erreur sur doitjouerSon, ".$this->PDOBDD->getMessageError();
                }
                return $result[0]['cheminSon'];
            }
        }
        return "";
    }

    /**
     * @return array|string
     */
    public function getListeBestiaire(){
        $requete = "SELECT * FROM `bestiaire` ORDER BY `nom` ASC";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getListeBestiaire, ".$this->PDOBDD->getMessageError();

            return array();
        }else{
            return $result;
        }
    }

    /**
     * @param $isCacher
     * @return array|string
     */
    public function getBestiaire($isCacher){
        $requete = "SELECT * FROM `bestiaire` WHERE `isCacher` like '".$isCacher."' ORDER BY `nom` ASC";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getBestiaire, ".$this->PDOBDD->getMessageError();

            return array();
        }else{
            return $result;
        }
    }

    /**
     * @param $IDMonstre
     * @return array
     */
    public function getMonstreID($IDMonstre){
        $requete = "SELECT * FROM `bestiaire` WHERE `id` like '".$IDMonstre."'";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getMonstreID, ".$this->PDOBDD->getMessageError();

            return array();
        }else if (count($result) != 0){
            return $result[0];
        }else{
            return array();
        }
    }

    /**
     * @param $nomMonstre
     * @return array
     */
    public function getMonstreNom($nomMonstre){
        $requete = "SELECT * FROM `bestiaire` WHERE `nom` like '".$nomMonstre."'";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getMonstreNom, ".$this->PDOBDD->getMessageError();

            return array();
        }else if (count($result) != 0){
            return $result[0];
        }else{
            return array();
        }
    }

    /**
     * @param $nomMonstre
     */
    public function addMonstre($nomMonstre){
        $requete = "INSERT INTO `bestiaire` (`nom`) VALUES ('".$nomMonstre."')";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur addMonstre, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param $IDMonstre
     */
    public function deleteMonstre($IDMonstre){
        $requete = "DELETE FROM `bestiaire` WHERE `id` = '".$IDMonstre."'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur deleteMonstre, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param $IDMonstre
     * @param $champMonstre
     * @param $valeurMonstre
     */
    public function modifierValeurMonstre($IDMonstre, $champMonstre, $valeurMonstre){
        $requete = "UPDATE `bestiaire` SET `".$champMonstre."` = '".$valeurMonstre."' WHERE `id` = '".$IDMonstre."'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur modifierValeurMonstre, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param $IDMonstre
     * @param $isCacher
     */
    public function cacherMonstre($IDMonstre, $isCacher){
        $requete = "UPDATE `bestiaire` SET `isCacher` = '".$isCacher."' WHERE `id` = '".$IDMonstre."'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur modifierValeurMonstre, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @return array|string
     */
    public function getListeNavire(){
        $requete = "SELECT * FROM `navire` ORDER BY `nom` ASC";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getListeNavire, ".$this->PDOBDD->getMessageError();

            return array();
        }else{
            return $result;
        }
    }

    /**
     * @param $IDNavire
     * @return array
     */
    public function getNavireID($IDNavire){
        $requete = "SELECT * FROM `navire` WHERE `id` like '".$IDNavire."'";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getNavireID, ".$this->PDOBDD->getMessageError();

            return array();
        }else if (count($result) != 0){
            return $result[0];
        }else{
            return array();
        }
    }

    /**
     * @param $nomNavire
     * @return array
     */
    public function getNavireNom($nomNavire){
        $requete = "SELECT * FROM `navire` WHERE `nom` like '".$nomNavire."'";

        $result = $this->PDOBDD->ExecuterRequete($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur getNavireNom, ".$this->PDOBDD->getMessageError();

            return array();
        }else if (count($result) != 0){
            return $result[0];
        }else{
            return array();
        }
    }

    /**
     * @param $nomNavire
     */
    public function addNavire($nomNavire){
        $requete = "INSERT INTO `navire` (`nom`) VALUES ('".$nomNavire."')";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur addNavire, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param $IDNavire
     */
    public function deleteNavire($IDNavire){
        $requete = "DELETE FROM `navire` WHERE `id` = '".$IDNavire."'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur deleteNavire, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     * @param $IDNavire
     * @param $champNavire
     * @param $valeurNavire
     */
    public function modifierValeurNavire($IDNavire, $champNavire, $valeurNavire){
        $requete = "UPDATE `navire` SET `".$champNavire."` = '".$valeurNavire."' WHERE `id` = '".$IDNavire."'";

        $this->PDOBDD->ExecuterRequeteNoReturn($requete);
        if ($this->PDOBDD->getErrorRequete()){
            $this->erreur = true;
            $this->MessageErreur = "erreur sur modifierValeurNavire, ".$this->PDOBDD->getMessageError();
        }
    }

    /**
     *
     */
    public function __destruct(){

    }
}

?>