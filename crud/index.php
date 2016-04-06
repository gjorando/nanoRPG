<?php
include_once("include/crudAccess.php");
include_once("../model/sessions.php");

$brb_target=!isLogged()?'inscription.php':'nouveauProjet.php';
$brb_title=!isLogged()?'INSCRIPTION':'CREATION';
$brb_sub=!isLogged()?'Inscrivez vous gratuitement en cliquant sur le gros bouton rouge !':'Commencez un nouveau jeu en un tour de main en cliquant sur le gros bouton rouge !';

$page_title = "Accueil";
include_once("../view/crud/index.php");
