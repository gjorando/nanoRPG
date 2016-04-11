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
			if(!empty($jeu['name'])) echo '<dt>' . ($jeu['sensible']?'<span title="Contenu sensible" class="jeu_sensible">/!\</span> ':'') . $jeu['name'] . '</dt><dd>' . ($detail?$desc . ($more?'...':'') . '<br />':'') . ($lib?('Dernièrement joué ' . ($jeu['last_played'] == null?'jamais':$jeu['last_played'])):('Dernière édition ' . $jeu['last_modified'])) . ' | <a href="pageDeJeu.php?id=' . $jeu['id'] . '">Page du jeu</a></dd>';
			else echo '<dt><span class="game_not_found">JEU INTROUVABLE :(</span></dt><dd>Vous voyez ceci, car le jeu d\'id ' . $jeu['id'] . ' est introuvable. Cela peut être dû à une suppression du jeu par son créateur. Veuillez nous excuser pour le désagrément occasionné.<br /><a href="gererLibrairie.php?id=' . $jeu['id'] . '&ghostDelete">Supprimer immédiatement l\'entrée fantôme de la librairie.</a></dd>';
		}
		echo '</dl>';
	}
	else
	{
		echo 'Rien ici... Pour le moment !';
	}
}

/*
 * Affiche la liste des demandes de suppression, le deuxième paramètre est à vrai si il s'agit des vieilles requêtes.
 */
function displayDeletionRequests($l, $old=false)
{
	if(!empty($l))
	{
		echo '<dl class="deletion_requests_list">';
		foreach($l as $req)
		{
			echo '<dt>Demande n°' . $req['id'] . ' : ' . (!empty($req['name'])?('<a href="/pageDeJeu.php?id=' . $req['id_game'] . '">' . $req['name'] . '</a>'):'jeu supprimé d\'id ' . $req['id_game']) . '</dt><dd>Postée par <a href="/profil.php?id=' . $req['id_requester'] . '">';
			displayPseudo($req['pseudo'], $req['admin']);
			echo '</a> le ' . $req['request_date'] . '<br />Raison : ' . $req['reason'];
			if($old)
			{
				echo '<hr />Traitée par : <a href="/profil.php?id=' . $req['id_admin'] . '">';
				displayPseudo($req['pseudo_admin'], true);
				echo '</a> le ' . $req['decision_date'] . '<br />Décision : ' . $req['decision'];
			}
			else
			{
				echo '<hr /><a href="traiterDemandeSuppressionJeu.php?id=' . $req['id'] . '">Traiter la requête</a>';
			}
			echo '</dd>';
		}
		echo '</dl>';
	}
	else
		echo 'Rien ici... Pour le moment !';
}

/*
 * Affiche la liste d'utilisateurs
 */
function displayUsersList($l)
{
	if(!empty($l))
	{
		echo '<table id="usersList">';
		echo '<tr><th>Pseudo</th><th>Nom complet</th></tr>';
		foreach($l as $utilisateur)
		{
			echo '<tr><td><a href="profil.php?id=' . $utilisateur['id'] . '"><img width="32" src="' . getAvatarPath($utilisateur['id'], $utilisateur['avatar']) . '" />';
			displayPseudo($utilisateur['pseudo'], $utilisateur['admin']);
		    echo '</a></td><td>' . $utilisateur['name'] . '</td></tr>';
		}
		echo '</table>';
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
 * Affiche un pager selon le lien et le nombre de pages demandés. Le 3e paramètre est la page actuelle, Le flag définit si le lien a déjà des paramètres get ou non. Le dernier paramètre permet de changer si nécéssaire le nom du paramètre get (défaut : page)
 */
function displayPager($l, $p, $a, $g = false, $n = "page")
{
	$slots = $p>=5?3:$p-2; //Correspond au nombre de pages qu'on peut afficher entre la première et la dernière page (Si négatif, sera traité comme 0 dans la suite du code)

	echo '<div class="pager">'; //On ouvre le div

	if($a != 1)
		echo '<a href="' . $l . ($g?'&':'?') . $n . '=' . ($a-1) . '">' . '<' . '</a> '; //Si on n'est pas à la page 1, on affiche le bouton page précédente

	echo '<a href="' . $l . ($g?'&':'?') . $n . '=1">' . '1' . '</a> '; //On affiche la première page

	if(($a-2>1) && ($p > 5)) //Si on a plus de 5 pages et qu'on est à 2 pages de la première page, on affiche les points de suspension
		echo '... ';
	
	$i=$a>$p-2?-2-($a-$p):0; //Offset de départ, pour le cas où on est à 2 pages ou moins de la fin
	while(($slots>0) && ($i < $p)) //Tant qu'on peut afficher des pages
	{
		if(($a-1+$i>1) && ($a-1+$i<$p)) //Si on ne tente d'afficher ni la première ni la dernière page, alors le fait
		{
			echo '<a href="' . $l . ($g?'&':'?') . $n . '=' . ($a-1+$i) . '">' . ($a-1+$i) . '</a> ';
			$slots--;
		}
		$i++;
	}

	if(($a+2<$p) && ($p > 5)) //Si on a plus de 5 pages et qu'on est à 2 pages de la dernière page, on affiche les points de suspension
		echo '... ';

	if($p > 1) //Si on a plus d'une page, alors on affiche la dernière page
		echo '<a href="' . $l . ($g?'&':'?') . $n . '=' . $p . '">' . $p . '</a> ';
	
	if($a != $p) //Si on n'est pas à la dernière page, alors on affiche le bouton page suivante
			echo '<a href="' . $l . ($g?'&':'?') . $n . '=' . ($a+1) . '">' . '>' . '</a> ';

	echo "</div>";
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
