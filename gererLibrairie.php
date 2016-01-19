<?php
include_once("model/sessions.php");
include_once("model/users.php");
include_once("model/games.php");
include_once("model/libraries.php");

if(!isset($_GET['id']))
	Header('Location: /');
else if(!isLogged())
	Header('Location: /');
else if(empty($jeu = getGameInfos($_GET['id'])))
	Header('Location: /');
else
{
	$jeu['name'] = htmlspecialchars($jeu['name']);

	if(isGameInLibrary(getUserId(), $jeu['id']))
	{
		removeFromLibrary(getUserId(), $_GET['id']);
		$page_title = 'Suppression de ' . $jeu['name'];
		$action = 'supprimé de';
	}
	else
	{
		addToLibrary(getUserId(), $_GET['id']);
		$page_title = 'Ajout de ' . $jeu['name'];
		$action = 'ajouté à';
	}

	include_once("view/gererLibrairie.php");
}
