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

$data['pseudo'] = htmlspecialchars($data['pseudo']);
$data['name'] = htmlspecialchars($data['name']);
$data['bio'] = nl2br(htmlspecialchars($data['bio']));

$avatar = '/img/';
$avatar.= $data['avatar']!=null?('data/avatars/' . $data['id'] . '.' . $data['avatar']):'default_avatar.png';

$editLink = ($data['id'] == getUserId())?'<div id="editLink"><a href="editerProfil.php">Modifier</a></div>':'';

$page_title = 'Profil de ' . $data['name'];
include_once("view/profil.php");

