<?php
session_start();

if (isset($_SESSION['perso'])) $personnage = $_SESSION['perso'];

include("../model/header.php");
include("./controleur.php");
?>