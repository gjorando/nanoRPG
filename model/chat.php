<?php
include_once($PROJECT_ROOT . 'model/connectBDD.php');

/*
 * Récupère les derniers messages (par défaut 100, tous si null)
 */
function getMessages($sender, $receiver, $qty=100)
{
	global $bdd;

	$req = $bdd->prepare('SELECT users.id as id_sender, users.avatar, users.admin, users.pseudo, chat.msg_body, DATE_FORMAT(chat.send_date, \'le %d/%m/%Y à %H:%i\') AS send_date FROM chat INNER JOIN users ON chat.id_sender = users.id WHERE (id_sender = :sender AND id_receiver = :receiver) OR (id_sender = :receiver AND id_receiver = :sender) ORDER BY send_date' . ($qty!=null?' LIMIT 0, :qty':''));
	$req->bindParam('sender', $sender, PDO::PARAM_INT);
	$req->bindParam('receiver', $receiver, PDO::PARAM_INT);
	if($qty != null)
		$req->bindParam('qty', $qty, PDO::PARAM_INT);
	
	$req->execute();

	$msgs = $req->fetchAll();

	return $msgs;
}

/*
 * Envoie un message chat
 */
function sendMessage($msg, $sender, $receiver)
{
	global $bdd;
	
	$req = $bdd->prepare('INSERT INTO chat(id_sender, id_receiver, msg_body, send_date) VALUES(:sender, :receiver, :msg, NOW())');

	$req->execute(array(
			'sender' => $sender,
			'receiver' => $receiver,
			'msg' => $msg));
}

/*
 * Compte les nouveaux messages d'un utilisateur. Si le dernier paramètre est défini, alors on compte les novueaux messages en provenance d'un utilisateur spécifique
 */
function countUnread($uid, $sid=NULL)
{
	global $bdd;

	$req = $bdd->prepare('SELECT COUNT(id) FROM chat WHERE id_receiver = :id AND hasBeenRead = 0' . ($sid?'AND id_sender = :sid':''));

	$req->bindParam('id', $uid, PDO::PARAM_INT);
	if($sid) $req->bindParam('sid', $sid, PDO::PARAM_INT);

	$req->execute();

	return $req->fetch()[0];
}
