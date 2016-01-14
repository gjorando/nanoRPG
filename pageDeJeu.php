<?php
include_once("model/sessions.php");
include_once("model/users.php");
include_once("model/games.php");

if(!isset($_GET['id']))
	Header('Location: /');
else
{
	$jeu = getGameInfos($_GET['id'], true);
	$jeu['name'] = htmlspecialchars($jeu['name']);
	$jeu['description'] = nl2br(htmlspecialchars($jeu['description']));
	$jeu['pseudo'] = htmlspecialchars($jeu['pseudo']);
	
	$avatar = getAvatarPath($jeu['id_creator'], $jeu['avatar']);

	$page_title = $jeu['name'];
	include_once("view/pageDeJeu.php");
}
