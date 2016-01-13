<?php
include_once("model/sessions.php");
include_once("model/users.php");
include_once("model/games.php");

if(isLogged() and !isset($_GET['id']))
{
	$utilisateur = getUserInfoById(getUserId());
	$uid = getUserId();
}
else
{
	if(isset($_GET['id']))
	{
		$utilisateur = getUserInfoById($_GET['id']);
		$uid = $_GET['id'];

		if($utilisateur == null)
			Header('Location: creations.php');
	}
	else
		Header('Location: ./');
}

$jeux = getGamesByUserId($uid);
foreach($jeux as $jeu)
{
	$jeu['name'] = htmlspecialchars($jeu['name']);
	$jeu['description'] = htmlspecialchars($jeu['description']);
}

$page_title = 'Créations de ' . $utilisateur['pseudo'];
include_once("view/creations.php");
