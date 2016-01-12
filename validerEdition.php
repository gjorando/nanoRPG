<?php
include_once("model/sessions.php");
include_once("model/users.php");

if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,}$#', $_POST['email']))
	Header('Location: editerProfil.php?err=1');
else if(strlen($_POST['nom']) > 40 or strlen($_POST['nom']) == 0)
	Header('Location: editerProfil.php?err=2');
else if(!empty($_POST['mdp']) and $_POST['mdp'] != $_POST['mdp_confirm'])
	Header('Location: editerProfil.php?err=3');
else if(!empty($_POST['mdp']) && $_POST['mdp'] < 10)
	Header('Location: editerProfil.php?err=4');
else
{
	$_SESSION['session_pswd'] = empty($_POST['mdp'])?$_SESSION['session_pswd']:sha1($_POST['mdp']);
	echo $_SESSION['session_pswd'];
	updateUser(null, null, $_POST['nom'], $_POST['genre'], $_POST['email'], null, $_POST['bio'], (!empty($_POST['mdp'])?$_POST['mdp']:null), false);
	Header('Location: profil.php');
}
