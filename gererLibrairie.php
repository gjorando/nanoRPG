<?php
include_once("model/sessions.php");
include_once("model/users.php");
include_once("model/games.php");
include_once("model/libraries.php");

if(!isset($_GET['id']))
	Header('Location: /');
else if(!isLogged())
	Header('Location: /');
else if(empty($jeu = getGameInfos($_GET['id'])) && !isset($_GET['ghostDelete']))
	Header('Location: /');
else
{
	$jeu['name'] = htmlspecialchars($jeu['name']);

	if(($gameInLibrary = isGameInLibrary(getUserId(), $_GET['id'])) || isset($_GET['ghostDelete']))
	{
		if(isset($_GET['confirm']) || isset($_GET['ghostDelete']))
		{
			removeFromLibrary(getUserId(), $_GET['id']);
			if(isset($_GET['ghostDelete'])) $jeu['name'] = "Le jeu fantôme d'id " . $_GET['id'];
			$action = 'supprimé de';
		}
		$page_title = 'Suppression de ' . $jeu['name'];
	}
	else
	{
		addToLibrary(getUserId(), $_GET['id']);
		$page_title = 'Ajout de ' . $jeu['name'];
		$action = 'ajouté à';
	}

	include_once("view/gererLibrairie.php");
}
