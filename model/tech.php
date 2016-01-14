<?php

/*
 * Prend la date au format DD/MM/YYYY pour retourner YYYY-MM-DD (format français->format sql)
 */
function prepareDate($myDate)
{
	$day = substr($myDate, 0, 2);
	$month = substr($myDate, 3, 2);
	$year = substr($myDate, 6);
	return $year . '-' . $month . '-' . $day;
}

/*
 * Prépare le chemin d'accès de l'avatar sur la base de l'id et de l'extension
 */
function getAvatarPath($id, $extension)
{
	return '/img/' . ($extension!=null?('data/avatars/' . $id . '.' . $extension):'default_avatar.png');
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
		echo '<dt>' . ($jeu['sensible']?'<span title="Contenu sensible" class="jeu_sensible">/!\</span> ':'') . $jeu['name'] . '</dt><dd>' . ($detail?$desc . ($more?'...':'') . '<br />':'') . 'Dernière édition : ' . $jeu['last_modified'] . ' | <a href="pageDeJeu.php?id=' . $jeu['id'] . '">Page du jeu</a></dd>';
	}
	echo '</dl>';
}

/*
 * Affiche le pseudo d'une couleur particulière en fonction de si c'est un admin ou non
 */
function displayPseudo($p, $a)
{
	echo '<span class="' . ($a?'adminP':'userP') . '">' . $p . '</span>';
}

/*
 * Fonction de débogage
 */
function print_var($v)
{
	echo '<pre>';
	print_r($v);
	echo '</pre>';
}
