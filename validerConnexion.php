<?php
include_once("model/sessions.php");
include_once("model/users.php");

if(!isset($_POST['pseudo']) or !isExistingPseudo($_POST['pseudo']))
	Header('Location: connexion.php?err=1');
else
{
	$user = getUserInfoByPseudo($_POST['pseudo']);
	if(sha1($_POST['mdp']) != $user['pswd'])
		Header('Location: connexion.php?err=2');
	else
	{
		$_SESSION['session_id'] = $user['id'];
		$_SESSION['session_pswd'] = $user['pswd'];

		$page_title = 'Bonjour ' . $user['nom'] . ' !';

		include_once("view/validerConnexion.php");
	}
}
