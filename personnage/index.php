<?php
session_start();

$_SESSION['perso'] = isset($_GET['perso']) ? $_GET['perso'] : "";
$action = isset($_GET['action']) ? $_GET['action'] : "fichePerso";

include("../model/header.php");
include("./controleur.php");
?>