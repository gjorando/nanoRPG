<?php
include_once($PROJECT_ROOT . "model/connectBDD.php");

/*
 * Retourne vrai si la suppression d'un jeu a déjà été demandée
 */
function deletionAlreadyRequested($id)
{
	global $bdd;

	$req = $bdd->prepare('SELECT id_game FROM game_delete WHERE id_game = :id');
	$req->execute(array('id' => (int) $id));
	
	return $req->fetch()[0]?true:false;
}

/*
 * Permet de sortir
 */
function awaitingRequests($debut=NULL, $limite=NULL)
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
