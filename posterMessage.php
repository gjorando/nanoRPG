<?php
include_once("model/sessions.php");
include_once("model/chat.php");
include_once("model/users.php");

if(!isLogged() or !isset($_GET['id']))
	Header('Location: /');
else if($_GET['id'] == getUserId())
	Header('Location: profil.php');
else if(!isExistingId($_GET['id']))
	Header('Location: profil.php');
else if(empty($_POST['msg']))
	Header('Location: chat.php?id=' . $_GET['id']);
else
{
	sendMessage($_POST['msg'], getUserId(), $_GET['id']);

	Header('Location: chat.php?id=' . $_GET['id']);
}	
