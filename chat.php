<?php
include_once("model/sessions.php");
include_once("model/users.php");
include_once("model/chat.php");

if(!isLogged() or !isset($_GET['id']))
	Header('Location: /');
else if($_GET['id'] == getUserId())
	Header('Location: profil.php');
else
{
	if(!($pseudo = isExistingId($_GET['id'])))
		Header('Location: profil.php');

	$messages = getMessages(getUserId(), $_GET['id']);

	if(!empty($messages))
		foreach($messages as &$msg)
		{
			$msg['pseudo'] = htmlspecialchars($msg['pseudo']);
			$msg['msg_body'] = nl2br(htmlspecialchars($msg['msg_body']));
		}

	$page_title = 'Discussion avec ' . $pseudo;
	include_once('view/chat.php');
}
