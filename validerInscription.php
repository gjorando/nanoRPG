<?php
include_once("model/sessions.php");
include_once("model/users.php");

if(empty($_POST['pseudo']) or empty($_POST['mdp']) or empty($_POST['mdp_confirm']) or empty($_POST['email']) or empty($_POST['name']) or empty($_POST['birth']) or empty($_POST['genre']))
	Header('Location: inscription.php?err=1');
else if($_POST['mdp'] != $_POST['mdp_confirm'])
	Header('Location: inscription.php?err=2');
else if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,}$#', strtolower($_POST['email'])))
	Header('Location: inscription.php?err=3');
else if(strlen($_POST['mdp']) < 10)
	Header('Location: inscription.php?err=4');
else if(strlen($_POST['pseudo']) > 20)
	Header('Location: inscription.php?err=5');
else if(strlen($_POST['name']) > 40)
	Header('Location: inscription.php?err=6');
else if(!preg_match('#^[0-9]{2}/[0-9]{2}/[0-9]{4}$#', $_POST['birth']))
	Header('Location: inscription.php?err=7');
else if(!isset($_POST['tos']))
	Header('Location: inscription.php?err=8');
else if(isExistingPseudo($_POST['pseudo']))
	Header('Location: inscription.php?err=9');
else if(isExistingEmail($_POST['email']))
	Header('Location: inscription.php?err=10');
else
{
	
	addUser($_POST['pseudo'], $_POST['name'], $_POST['genre'], $_POST['email'], prepareDate($_POST['birth']), $_POST['mdp']);
	$_POST['name'] = htmlspecialchars($_POST['name']);

	$page_title = 'Bienvenue ' . $_POST['name'] . ' !';	
	include_once('view/validerInscription.php');
}

