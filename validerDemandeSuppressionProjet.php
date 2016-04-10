<?php
include_once("model/sessions.php");
include_once("model/users.php");
include_once("model/games.php");
include_once("model/game_delete.php");

if(!isLogged() or empty($_POST))
	Header('Location: /');
else if(!isset($_GET['id']))
	header('Location: /');
else if(!($game = getGameInfos($_GET['id'])))
	header('Location: /');
else if((!($adminMode = isAdmin(getUserId()))) && (getUserId() != $game['id_creator']))
	header('Location: ./');
else if(deletionAlreadyRequested($_GET['id']))
	header('Location: pageDeJeu.php?id=' . $_GET['id']);
else if(strlen($_POST['reason']) < 40)
	Header('Location: demanderSuppressionProjet.php?id=' . $_GET['id'] . '&err=1');
else
{
	newDeletionRequest($_GET['id'], getUserId(), $_POST['reason']);

	$page_title = "Demande de suppression effectuée";
	include_once('view/validerDemandeSuppressionProjet.php');
}

