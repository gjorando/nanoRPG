<?php
include_once("model/sessions.php");
include_once("model/users.php");
include_once("model/games.php");
include_once("model/libraries.php");

if(isLogged() and !isset($_GET['id']))
{
	$data = getUserInfoById(getUserId());
	$uid = getUserId();
}
else
{
	if(isset($_GET['id']))
	{
		$data = getUserInfoById($_GET['id']);
		$uid = $_GET['id'];

		if($data == null)
			Header('Location: profil.php');
	}
	else
		Header('Location: ./');
}
$data['pseudo'] = htmlspecialchars($data['pseudo']);
$data['name'] = htmlspecialchars($data['name']);
$data['bio'] = nl2br(htmlspecialchars($data['bio']));

$avatar = getAvatarPath($data['id'], $data['avatar']);

$editLink = isLogged()?($data['id'] == getUserId())?'<div id="editLink"><a href="editerProfil.php">Modifier</a></div>':'':'';

$jeux = getLastGames($uid);
foreach($jeux as $jeu)
{
	$jeu['name'] = htmlspecialchars($jeu['name']);
}

$libs = getLastPlayed($uid);
foreach($libs as $lib)
{
	$lib['name'] = htmlspecialchars($lib['name']);
}

$page_title = 'Profil de ' . $data['name'];
include_once("view/profil.php");

