<?php
include_once($PROJECT_ROOT . "model/connectBDD.php");

/*
 * Retourne vrai si la suppression d'un jeu a déjà été demandée
 */
function deletionAlreadyRequested($id)
{
	global $bdd;

	$req = $bdd->prepare('SELECT id_game FROM game_delete WHERE status = 0 AND id_game = :id');
	$req->execute(array('id' => (int) $id));
	
	return $req->fetch()[0]?true:false;
}

/*
 * Permet de récupérer les requêtes de suppression en attente de traitement
 */
function awaitingDeletionRequests($debut=NULL, $limite=NULL)
{
	global $bdd;

	$reqString = 'SELECT game_delete.id, game_delete.id_game, games.name, game_delete.id_requester, users.pseudo, users.admin, game_delete.reason, DATE_FORMAT(game_delete.request_date, \'%d/%m/%Y à %H:%i\') AS request_date FROM game_delete INNER JOIN games ON game_delete.id_game = games.id INNER JOIN users ON game_delete.id_requester = users.id WHERE status = 0 ORDER BY request_date';
	
	if ($debut!=null or $limite!=null)
	{
		$limite = (int) $limite;
		$debut = (int) $debut;
		$reqString.= ' LIMIT :begin, :limit';
	}
	
	$req = $bdd->prepare($reqString);
	
	if ($debut != null or $limite != null)
	{
		$req->bindParam('begin', $debut, PDO::PARAM_INT);
		$req->bindParam('limit', $limite, PDO::PARAM_INT);
	}
	$req->execute();
	$requestsInfo = $req->fetchAll();

	return $requestsInfo;

}

/*
 * Récupère la requête de suppression selon son id (ajoute les informations de décision si $old)
 */
function getDeletionRequestById($id, $old=false)
{
	global $bdd;

	$req = $bdd->prepare('SELECT game_delete.id, game_delete.id_game, games.name, game_delete.id_requester, users.pseudo, users.admin, game_delete.reason, DATE_FORMAT(game_delete.request_date, \'%d/%m/%Y à %H:%i\') AS request_date' . ($old?', DATE_FORMAT(game_delete.decision_date, \'%d/%m/%Y à %H:%i\') AS decision_date, game_delete.decision, game_delete.id_admin, userAdmin.pseudo AS pseudo_admin':'') . ' FROM game_delete LEFT JOIN games ON game_delete.id_game = games.id INNER JOIN users ON game_delete.id_requester = users.id' . ($old?' LEFT JOIN users AS userAdmin ON game_delete.id_admin = userAdmin.id':'') . ' WHERE game_delete.id = :id');
	
	$req->execute(array('id' => (int) $id));
	$requestInfo = $req->fetch();

	return $requestInfo;
}

/*
 * Permet de récupérer les requêtes de suppression déjà traitées
 */
function oldDeletionRequests($debut=NULL, $limite=NULL)
{
	global $bdd;

	$reqString = 'SELECT game_delete.id, game_delete.id_game, games.name, game_delete.id_requester, users.pseudo, users.admin, game_delete.reason, DATE_FORMAT(game_delete.request_date, \'%d/%m/%Y à %H:%i\') AS request_date, DATE_FORMAT(game_delete.decision_date, \'%d/%m/%Y à %H:%i\') AS decision_date, game_delete.decision, game_delete.id_admin, userAdmin.pseudo AS pseudo_admin FROM game_delete LEFT JOIN games ON game_delete.id_game = games.id INNER JOIN users ON game_delete.id_requester = users.id INNER JOIN users AS userAdmin ON game_delete.id_admin = userAdmin.id WHERE status = 1 ORDER BY decision_date DESC';
	
	if ($debut!=null or $limite!=null)
	{
		$limite = (int) $limite;
		$debut = (int) $debut;
		$reqString.= ' LIMIT :begin, :limit';
	}
	
	$req = $bdd->prepare($reqString);
	
	if ($debut != null or $limite != null)
	{
		$req->bindParam('begin', $debut, PDO::PARAM_INT);
		$req->bindParam('limit', $limite, PDO::PARAM_INT);
	}
	$req->execute();
	$requestsInfo = $req->fetchAll();

	return $requestsInfo;

}


/*
 * Retourne le nombre de requêtes en attente
 */
function countAwaitingDeletionRequests()
{
	global $bdd;

	$req = $bdd->query('SELECT COUNT(id) FROM game_delete WHERE status = 0');

	return $req->fetch()[0];
}

/*
 * Retourne le nombre de requêtes traitées
 */
function countOldDeletionRequests()
{
	global $bdd;

	$req = $bdd->query('SELECT COUNT(id) FROM game_delete WHERE status = 1');

	return $req->fetch()[0];
}

/*
 * Crée une nouvelle demande de suppression de projet
 */
function newDeletionRequest($idG, $idR, $r)
{
	global $bdd;

	$req = $bdd->prepare('INSERT INTO game_delete(id_game, id_requester, reason) VALUES(:idG, :idR, :r)');

	$req->execute(array(
			'idG' => $idG,
			'idR' => $idR,
			'r' => $r));
}

function closeDeletionRequest($id, $dec, $idA)
{
	global $bdd;

	$req = $bdd->prepare('UPDATE game_delete SET status = 1, decision = :dec, id_admin = :ida, decision_date = NOW() WHERE id = :id');

	$req->execute(array(
			'dec' => $dec,
			'ida' => $idA,
			'id' => $id));
}
