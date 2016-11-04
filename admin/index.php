<?php
session_start();

$personnage = isset($_GET['perso']) ? $_GET['perso'] : "";
$monstre = isset($_GET['monstre']) ? $_GET['monstre'] : "";
$carte = isset($_GET['carte']) ? $_GET['carte'] : "";
$navire = isset($_GET['navire']) ? $_GET['navire'] : "";
$navireAdverse = isset($_GET['navireAdverse']) ? $_GET['navireAdverse'] : "";
$action = isset($_GET['action']) ? $_GET['action'] : "fichePerso";
if ($monstre != "") $_SESSION['monstre'] = $monstre;
if ($personnage != "") $_SESSION['perso'] = $personnage;
if ($carte != "") $_SESSION['carte'] = $carte;
if ($navire != "") $_SESSION['navire'] = $navire;
if ($navireAdverse != "") $_SESSION['navireAdverse'] = $navireAdverse;

include("../model/header.php");
include("./controleur.php");
?>