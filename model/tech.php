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
 * Affiche une liste de jeux en fonction du paramètre renseigné. $detail à vrai affiche un aperçu de la description. $lib à vrai si on veut afficher la librairie
 */
function displayGameList($l, $detail=false, $lib=false)
{
	if(!empty($l))
	{
		echo '<dl class="games_list' . ($detail?' list_tous"':'"') . '>';
		foreach($l as $jeu)
		{
			if($detail)
			{			
				$desc = substr($jeu['description'], 0, 40);
				$more = strlen($desc)==strlen($jeu['description'])?false:true;
			}
			echo '<dt>' . ($jeu['sensible']?'<span title="Contenu sensible" class="jeu_sensible">/!\</span> ':'') . $jeu['name'] . '</dt><dd>' . ($detail?$desc . ($more?'...':'') . '<br />':'') . ($lib?('Dernièrement joué ' . ($jeu['last_played'] == null?'jamais':$jeu['last_played'])):('Dernière édition ' . $jeu['last_modified'])) . ' | <a href="pageDeJeu.php?id=' . $jeu['id'] . '">Page du jeu</a></dd>';
		}
		echo '</dl>';
	}
	else
	{
		echo 'Rien ici... Pour le moment !';
	}
}

/*
 * Affiche le pseudo d'une couleur particulière en fonction de si c'est un admin ou non
 */
function displayPseudo($p, $a)
{
	echo '<span class="' . ($a?'adminP':'userP') . '">' . $p . '</span>';
}

/*
 * Affiche un pager selon le lien et le nombre de pages demandés. Le 3e paramètre est la page actuelle, Le flag définit si le lien a déjà des paramètres get ou non
 */
function displayPager($l, $p, $a, $g = false)
{
	echo '<div class="pager">';
	$i = 1;

	$a = (int) $a;
	$a = ($a > 0 and $a <= $p)?$a:1;

	if($a != 1)
		echo '<a href="' . $l . ($g?'&':'?') . 'page=' . ($a-1) . '">' . '<' . '</a> ';

	while($i <= $p and $i < 5)
	{
		echo '<a href="' . $l . ($g?'&':'?') . 'page=' . $i . '">' . $i . '</a> ';
		$i++;
	}
	
	if($i > 5)
	{
		echo '... <a href="' . $l . ($g?'&':'?') . 'page=' . $p . '">' . $p . '</a> ';
	}

	if($a != $p)
		echo '<a href="' . $l . ($g?'&':'?') . 'page=' . ($a+1) . '">' . '>' . '</a> ';
}

/*
 * Affiche un Big red button avec un titre et une cible
 */
function displayBRB($bTitle, $bTarget)
{
	echo '<a class="BRB" href="' . $bTarget . '"><span>' . $bTitle . '</span></a>';
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
