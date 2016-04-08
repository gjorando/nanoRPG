<?php
include_once("model/sessions.php");
include_once("model/users.php");
include_once("model/games.php");
include_once("model/libraries.php");
include_once("model/game_delete.php");

if(!isset($_GET['id']))
	Header('Location: /');
else
{
	$jeu = getGameInfos($_GET['id'], true);
	if($jeu == null)
			Header('Location: /');

	$jeu['name'] = htmlspecialchars($jeu['name']);
	$jeu['description'] = nl2br(htmlspecialchars($jeu['description']));
	$jeu['pseudo'] = htmlspecialchars($jeu['pseudo']);

	$adminMode = isAdmin(getUserId());
	$editable = (isLogged() && (($ownGame = ($jeu['id_creator'] == getUserId())) || $adminMode));
	$playable = isLogged()?true:false;

	if($playable)
	{
		$deleteGame = isGameInLibrary(getUserId(), $jeu['id']);
	}

	$avatar = getAvatarPath($jeu['id_creator'], $jeu['avatar']);

	$page_title = $jeu['name'];
	include_once("view/pageDeJeu.php");
}
