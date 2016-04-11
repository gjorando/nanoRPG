<?php
include_once("../model/crudAccess.php");
include_once("../model/sessions.php");
include_once("../model/game_delete.php");
include_once("../model/libraries.php");

if(!isset($_GET['id']))
	header('Location: ./');
else if(!($req = getDeletionRequestById($_GET['id'])))
	header('Location: ./');
else
{
	if(isset($_GET['err']))
	{
		$err = "<div id=\"err\" class=\"icon\">";
		switch($_GET['err'])
		{
			case 1:
				$err.= "Merci de préciser la décision de la requête de suppression de projet (au moins 40 caractères) !";
				break;
			case 2:
				$err.= "Merci de sélectionner une action !";
				break;
			case 3:
				$err.= "Merci de renseigner un id valable pour la migration !";
				break;
			default:
				$err.= "Cessez donc de modifier l'URL, petit malandrin !";
		}
		$err.= "</div>";
	}
	else
		$err='';

	
	$req['name'] = htmlspecialchars($req['name']);
	$req['reason'] = nl2br(htmlspecialchars($req['reason']));
	$req['pseudo'] = htmlspecialchars($req['pseudo']);

	$playersCount = countLibraryEntriesByGameId($req['id_game']);

	$page_title = "Examen de la requête n°" . $_GET['id'];
	include_once("../view/crud/traiterDemandeSuppressionJeu.php");
}
