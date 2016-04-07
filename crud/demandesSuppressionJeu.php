<?php
include_once("../model/crudAccess.php");
include_once("../model/sessions.php");
include_once("../model/game_delete.php");
include_once("../model/tech.php");

$awaiting = awaitingRequests();

foreach($awaiting as &$info)
{
	$info['name'] = htmlspecialchars($info['name']);
	$info['pseudo'] = htmlspecialchars($info['pseudo']);
	$info['reason'] = nl2br(htmlspecialchars($info['reason']));
}

$page_title = "Demandes de suppression de jeu";
include_once("../view/crud/demandesSuppressionJeu.php");
