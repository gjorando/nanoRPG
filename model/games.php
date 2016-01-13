<?php
include_once("model/connectBDD.php");

/*
 * Retourne la liste des jeux d'un utilisateur. Si il y a une limite, sort seulement les $limit derniers jeux (par date de modification)
 */
function getGamesByUserId($id, $limite=NULL)
{
	global $bdd;

	$reqString = 'SELECT id, id_creator, name, description, sensible, DATE_FORMAT(last_modified, \'le %d/%m/%Y à %H:%i\') AS last_modified FROM games WHERE id_creator = :id ';
	
	if ($limite!=null)
	{
		$limite = (int) $limite;
		$reqString.= 'ORDER BY last_modified DESC LIMIT 0, :limit';
	}
	else
	{
		$reqString.= 'ORDER BY name';
	}

	$req = $bdd->prepare($reqString);
	
	$req->bindParam('id', $id, PDO::PARAM_INT);
	if ($limite != null)
		$req->bindParam('limit', $limite, PDO::PARAM_INT);
	$req->execute();
	$gamesInfo = $req->fetchAll();

	return $gamesInfo;
}

/*
 * Affiche une liste de jeux en fonction du paramètre renseigné. $detail à vrai affiche un aperçu de la description
 */
function displayGameList($l, $detail=false)
{
	echo '<dl class="games_list' . ($detail?' list_tous"':'"') . '>';
	foreach($l as $jeu)
	{
		if($detail)
		{			
			$desc = substr($jeu['description'], 0, 40);
			$more = strlen($desc)==strlen($jeu['description'])?false:true;
		}
		echo '<dt>' . ($jeu['sensible']?'<span title="Contenu sensible" class="jeu_sensible">/!\</span> ':'') . $jeu['name'] . '</dt><dd>' . ($detail?$desc . ($more?'...':'') . '<br />':'') . 'Dernière édition : ' . $jeu['last_modified'] . ' | <a href="pageDuJeu.php?id=' . $jeu['id'] . '">Page du jeu</a></dd>';
	}
	echo '</dl>';
}

/*
 * Retourne les informations d'un jeu selon son id
 */
