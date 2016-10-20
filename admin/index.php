<?php
session_start();

$personnage = isset($_GET['perso']) ? $_GET['perso'] : "";
$monstre = isset($_GET['monstre']) ? $_GET['monstre'] : "";
$carte = isset($_GET['carte']) ? $_GET['carte'] : "";
$action = isset($_GET['action']) ? $_GET['action'] : "fichePerso";
if ($monstre != "") $_SESSION['monstre'] = $monstre;
if ($personnage != "") $_SESSION['perso'] = $personnage;
if ($carte != "") $_SESSION['carte'] = $carte;

include("../model/header.php");
include("./controleur.php");
?>