<?php
include_once('model/sessions.php');
include_once('model/users.php');
include_once('model/games.php');
include_once("model/game_delete.php");

if(!isLogged())
	header('Location: ./');
else if(!isset($_GET['id']))
	header('Location: ./');
else if(!($game = getGameInfos($_GET['id'])))
	header('Location: ./');
else if((!($adminMode = isAdmin(getUserId()))) && (getUserId() != $game['id_creator']))
	header('Location: ./');
else if(deletionAlreadyRequested($_GET['id']))
	header('Location: pageDeJeu.php?id=' . $_GET['id']);
else
{
	$ownGame = getUserId() == $game['id_creator'];
	if(isset($_GET['err']))
	{
		$err = "<div id=\"err\" class=\"icon\">";
		switch($_GET['err'])
		{
			case 1:
				$err.= "Merci de donner une raison à la requête de suppression de projet (au moins 40 caractères) !";
				break;
			default:
				$err.= "Cessez donc de modifier l'URL, petit malandrin !";
		}
		$err.= "</div>";
	}
	else
		$err='';

	$game['name'] = htmlspecialchars($game['name']);
	
	$page_title="Demande de suppression de " . $game['name'];
	include_once("view/demanderSuppressionProjet.php");
}
