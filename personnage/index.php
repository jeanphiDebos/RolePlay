<?php
session_start();

$personnage = isset($_GET['perso']) ? $_GET['perso'] : "";
$action = isset($_GET['action']) ? $_GET['action'] : "fichePerso";
$_SESSION['perso'] = $personnage;

include("../model/header.php");
include("./controleur.php");
?>