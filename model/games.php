<?php
include_once($PROJECT_ROOT . "model/connectBDD.php");

/*
 * Crée un nouveau jeu
 */
function addGame($id, $n, $d, $s)
{
	global $bdd;

	$req = $bdd->prepare('INSERT INTO games(id_creator, name, description, sensible) VALUES(:id, :name, :desc, :sensible)');
	$req->execute(array(
			'id' => $id,
			'name' => $n,
			'desc' => $d,
			'sensible' => $s));
}

/*
 * Supprime un jeu : si $id_creator est différent de null, alors on n'effectue la suppression que si le jeu appartient au membre d'id $id_creator
 * N.B : choix a été fait de ne pas supprimer les entrées dans les librairies, afin que les utilisateurs se rendent compte clairement de la disparition du jeu 
 */
function deleteGame($id, $id_creator=NULL)
{
	global $bdd;

	//TODO Gérer la suppression du contenu du jeu (quand il sera implémenté)

	$reqString = 'DELETE FROM games WHERE id = :id';

	if($id_creator!=null)
		$reqString.= ' AND id_creator = :idc';

	$req = $bdd->prepare($reqString);

	$req->bindParam('id', $id, PDO::PARAM_INT);
	if($id_creator!=null) $req->bindParam('idc', $id_creator, PDO::PARAM_INT);

	$req->execute();
}

/*
 * Change de propriétaire le jeu
 */
function migrateGame($id, $idNewUser)
{
	updateGame($id, $idNewUser, null, null, null, false);
}

/*
 * Met à jour un jeu (le dernier paramètre vaut vrai si on veut mettre à jour la date de modification)
 */
function updateGame($id, $idC, $name, $description, $sensible, $touch=true)
{
	global $bdd;
	
	$reqString = 'UPDATE games SET';
	$putComma = false;
	$reqArray = array();

	if($idC != null)
	{
		$reqString.= ' id_creator = :idC';
		$putComma = true;
		$reqArray['idC'] = $idC;
	}
	if($name != null)
	{
		$reqString.= ($putComma?',':'') . ' name = :name';
		$putComma = true;
		$reqArray['name'] = $name;
	}
	if($description != null)
	{
		$reqString.= ($putComma?',':'') . ' description = :desc';
		$putComma = true;
		$reqArray['desc'] = $description;
	}
	if($sensible != null)
	{
		$reqString.= ($putComma?',':'') . ' sensible = :sensible';
		$putComma = true;
		$reqArray['sensible'] = $sensible;
	}
	if($touch)
	{
		$reqString.= ($putComma?',':'') . ' last_modified = NOW()';
		$putComma = true;
	}
	
	$reqString.= ' WHERE id = :id';
	$reqArray['id'] = $id;

	$req = $bdd->prepare($reqString);
	$req->execute($reqArray);
}


/*
 * Retourne la liste des jeux d'un utilisateur. Si il y a une limite, sort seulement les $limit derniers jeux (par date de modification)
 */
function getGamesByUserId($id, $debut=NULL, $limite=NULL)
{
	global $bdd;

	$reqString = 'SELECT id, id_creator, name, description, sensible, DATE_FORMAT(last_modified, \'le %d/%m/%Y à %H:%i\') AS last_modified FROM games WHERE id_creator = :id ORDER BY name';
	
	if ($debut!=null or $limite!=null)
	{
		$limite = (int) $limite;
		$debut = (int) $debut;
		$reqString.= ' LIMIT :begin, :limit';
	}
	
	$req = $bdd->prepare($reqString);
	
	$req->bindParam('id', $id, PDO::PARAM_INT);
	if ($debut != null or $limite != null)
	{
		$req->bindParam('begin', $debut, PDO::PARAM_INT);
		$req->bindParam('limit', $limite, PDO::PARAM_INT);
	}
	$req->execute();
	$gamesInfo = $req->fetchAll();

	return $gamesInfo;
}

/*
 * Retourne la quantité de jeux d'un utilisateur
 */
function getGamesCountByUserId($id)
{
	global $bdd;

	$req = $bdd->prepare('SELECT COUNT(id) FROM games WHERE id_creator = :id');
	$req->execute(array('id' => (int) $id));
	$gamesCount = $req->fetch()[0];
	return $gamesCount;
}

/*
 * Sort une liste des derniers jeux
 */
function getLastGames($id, $limite=3)
{
	global $bdd;

	$req = $bdd->prepare('SELECT id, id_creator, name, sensible, DATE_FORMAT(last_modified, \'le %d/%m/%Y à %H:%i\') AS last_modified FROM games WHERE id_creator = :id ORDER BY last_modified DESC LIMIT 0, :limit');

	$req->bindParam('id', $id, PDO::PARAM_INT);
	$req->bindParam('limit', $limite, PDO::PARAM_INT);
	$req->execute();
	$gamesInfo = $req->fetchAll();

	return $gamesInfo;
}

/*
 * Retourne les informations d'un jeu selon son id. Si le flag est à true, joint les infos du créateur
 */
function getGameInfos($id, $userJoin=false)
{
	global $bdd;
	
	$reqString = 'SELECT games.id, games.id_creator, games.name, games.description, games.sensible, DATE_FORMAT(games.last_modified, \'le %d/%m/%Y à %H:%i\') AS last_modified' . ($userJoin?', users.pseudo, users.avatar, users.admin':'') . ' FROM games' . ($userJoin?' INNER JOIN users ON games.id_creator = users.id':'') . ' WHERE games.id = :id';

	$req = $bdd->prepare($reqString);
	$req->execute(array('id' => $id));
	return $req->fetch();
}
