<?php
include_once('model/connectBDD.php');

/*
 * Retourne les $limite derniers jeux
 */
function getLastPlayed($id, $limite=3)
{
	global $bdd;

	$req = $bdd->prepare('SELECT games.name, games.id, games.sensible, DATE_FORMAT(libraries.last_played, \'le %d/%m/%Y à %H:%i\') AS last_played FROM libraries INNER JOIN games ON libraries.id_game = games.id WHERE libraries.id_user = :id ORDER BY libraries.last_played DESC LIMIT 0, :limit');

	$req->bindParam('id', $id, PDO::PARAM_INT);
	$req->bindParam('limit', $limite, PDO::PARAM_INT);
	$req->execute();
	
	$lib = $req->fetchAll();

	return $lib;
}

/*
 * Retourne la quantité de jeux dans la librairie du joueur d'id renseigné
 */
function getLibraryCountByUserId($id)
{
	global $bdd;

	$req = $bdd->prepare('SELECT COUNT(id) FROM libraries WHERE id_user = :id');
	$req->execute(array('id' => (int) $id));
	$gamesCount = $req->fetch()[0];
	return $gamesCount;

}

/*
 * Retourne les jeux de la librairie d'un joueur
 */
function getLibraryByUserId($id, $debut=NULL, $limite=NULL)
{
	global $bdd;

	$reqString = 'SELECT games.id, games.id_creator, games.name, games.description, games.sensible, DATE_FORMAT(libraries.last_played, \'le %d/%m/%Y à %H:%i\') AS last_played FROM libraries INNER JOIN games ON libraries.id_game = games.id WHERE id_user = :id ORDER BY name';
	
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
 * Retourne vrai si le jeu est dans la librairie du joueur
 */
function isGameInLibrary($id, $idGame)
{
	global $bdd;
	
	$req = $bdd->prepare('SELECT id FROM libraries WHERE id_user = :id AND id_game = :idg');
	$req->execute(array('id' => $id, 'idg' => $idGame));

	return !empty($req->fetchAll());
}

/*
 * Ajoute à la librairie de l'utilisateur d'id $id le jeu d'id $idGame
 */
function addToLibrary($id, $idGame)
{
	global $bdd;

	$req = $bdd->prepare('INSERT INTO libraries(id_user, id_game) VALUES(:id, :idG)');
	$req->execute(array(
			'id' => $id,
			'idG' => $idGame));
}

/*
 * Retire de la librairie de l'utilisateur d'id $id le jeu d'id $idGame
 */
function removeFromLibrary($id, $idGame)
{
	global $bdd;

	$req = $bdd->prepare('DELETE FROM libraries WHERE id_user = :id AND id_game = :idG');
	$req->execute(array(
			'id' => $id,
			'idG' => $idGame));
}
