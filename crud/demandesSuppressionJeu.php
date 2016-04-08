<?php
include_once("../model/crudAccess.php");
include_once("../model/sessions.php");
include_once("../model/game_delete.php");
include_once("../model/tech.php");

$qteEnAttente = countAwaitingDeletionRequests();
$enAttenteParPage = 10;

$debutA = 0;
$finA = $enAttenteParPage;
$qtePagesA = (int) ($qteEnAttente/$enAttenteParPage)+($qteEnAttente%$enAttenteParPage == 0?0:1);
if(isset($_GET['pageA']))
{
	$pageA = (int) $_GET['pageA'];
	
	if($pageA > 1 and $pageA <= $qtePagesA)
		$debutA = ($pageA - 1)*$enAttenteParPage;
	else
		$pageA = 1;
}
else
	$pageA = 1;

$qteAncien = countOldDeletionRequests();
$ancienParPage = 3;

$debutO = 0;
$finO = $ancienParPage;
$qtePagesO = (int) ($qteAncien/$ancienParPage)+($qteAncien%$ancienParPage == 0?0:1);
if(isset($_GET['pageO']))
{
	$pageO = (int) $_GET['pageO'];
	
	if($pageO > 1 and $pageO <= $qtePagesO)
		$debutO = ($pageO - 1)*$ancienParPage;
	else
		$pageO = 1;
}
else
	$pageO = 1;


$awaiting = awaitingDeletionRequests($debutA, $finA);
$old = oldDeletionRequests($debutO, $finO);

foreach($awaiting as &$info)
{
	$info['name'] = htmlspecialchars($info['name']);
	$info['pseudo'] = htmlspecialchars($info['pseudo']);
	$info['reason'] = nl2br(htmlspecialchars($info['reason']));
}

foreach($old as &$info)
{
	$info['name'] = htmlspecialchars($info['name']);
	$info['pseudo'] = htmlspecialchars($info['pseudo']);
	$info['reason'] = nl2br(htmlspecialchars($info['reason']));
}


$page_title = "Demandes de suppression de jeu";
include_once("../view/crud/demandesSuppressionJeu.php");
