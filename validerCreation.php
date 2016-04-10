<?php
include_once("model/sessions.php");
include_once("model/users.php");
include_once("model/games.php");

if(!isLogged() or empty($_POST))
	Header('Location: /');
else if(empty($_POST['name']) or empty($_POST['desc']))
	Header('Location: nouveauProjet.php?err=1');
else if(strlen($_POST['name']) > 60)
	Header('Location: nouveauProjet.php?err=2');
else
{
	addGame(getUserId(), $_POST['name'], $_POST['desc'], isset($_POST['sensible'])?true:false);

	$_POST['name'] = htmlspecialchars($_POST['name']);

	$page_title = 'Création de ' . $_POST['name'] . ' confirmée !';	
	include_once('view/validerCreation.php');
}

