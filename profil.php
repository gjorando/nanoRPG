<?php
include_once("model/sessions.php");
include_once("model/users.php");

if(isLogged() and !isset($_GET['id']))
{
	$data = getUserInfoById(getUserId());	
}
else
{
	if(isset($_GET['id']))
	{
		$data = getUserInfoById($_GET['id']);
		if($data == null)
			Header('Location: profil.php');
	}
	else
		Header('Location: profil.php');
}

$avatar = '/img/data/avatars/';
$avatar.= $data['avatar']?($data['id'] . '.png'):'default.png';

$editLink = ($data['id'] == getUserId())?'<div id="editLink"><a href="editerProfil.php">Modifier</a></div>':'';

$page_title = 'Profil de ' . $data['nom'];
include_once("view/profil.php");

