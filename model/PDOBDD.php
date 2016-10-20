<?php

/**
 * Class PDOBDD
 */
class PDOBDD{
    /**
     * @var
     */
    private $serveur;
    /**
     * @var
     */
    private $nomBDD;
    /**
     * @var
     */
    private $loginBDD;
    /**
     * @var
     */
    private $passwordBDD;
    /**
     * @var PDO
     */
    private $PDOConnection;
    /**
     * @var bool
     */
    private $errorConnection;
    /**
     * @var bool
     */
    private $errorRequete;
    /**
     * @var string
     */
    private $MessageError;

    /**
     * @param $serveur
     * @param $nomBDD
     * @param $loginBDD
     * @param $passwordBDD
     */
    public function newConnection($serveur, $nomBDD, $loginBDD, $passwordBDD){
        $this->__construct($serveur, $nomBDD, $loginBDD, $passwordBDD);
    }

    /**
     * PDOBDD constructor.
     * @param $serveur
     * @param $nomBDD
     * @param $loginBDD
     * @param $passwordBDD
     */
    public function __construct($serveur, $nomBDD, $loginBDD, $passwordBDD){
        $this->serveur = $serveur;
        $this->nomBDD = $nomBDD;
        $this->loginBDD = $loginBDD;
        $this->passwordBDD = $passwordBDD;
        $this->errorConnection = false;
        $this->errorRequete = false;
        $this->MessageError = "";
        $this->ConnectionPDOBDD();
    }

    /**
     *
     */
    private function ConnectionPDOBDD(){
        try{
            $dns = 'mysql:host='.$this->serveur.';dbname='.$this->nomBDD;
            $PDOConnection = new PDO($dns, $this->loginBDD, $this->passwordBDD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'', PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
            $PDOConnection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $PDOConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->PDOConnection = $PDOConnection;
        }catch (PDOException $e){
            $this->errorConnection = true;
            $this->MessageError = $e->getMessage();
        }
    }

    /**
     * @param $requete
     * @return string
     */
    public function ExecuterRequete($requete){
        $this->errorRequete = false;
        $this->MessageError = "";

        try{
            $resultatRequete = $this->PDOConnection->query($requete)->fetchAll();

            return $resultatRequete;
        }catch (PDOException $e){
            $this->errorRequete = true;
            $this->MessageError = $e->getMessage();

            return "";
        }
    }

    /**
     * @param $requete
     */
    public function ExecuterRequeteNoReturn($requete){
        $this->errorRequete = false;
        $this->MessageError = "";

        try{
            $this->PDOConnection->query($requete);
        }catch (PDOException $e){
            $this->errorRequete = true;
            $this->MessageError = $e->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public function getPDOConnection(){
        return $this->PDOConnection;
    }

    /**
     * @return bool
     */
    public function getErrorConnection(){
        return $this->errorConnection;
    }

    /**
     * @return bool
     */
    public function getErrorRequete(){
        return $this->errorRequete;
    }

    /**
     * @return string
     */
    public function getMessageError(){
        return $this->MessageError;
    }

    /**
     *
     */
    public function __destruct(){

    }
}

?>