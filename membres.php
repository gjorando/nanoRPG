<?php
include_once("model/sessions.php");
include_once("model/users.php");

$qteUtilisateurs = getUsersCount();
$utilisateursParPage = 15;

$debut = 0;
$fin = $utilisateursParPage;
$qtePages = (int) ($qteUtilisateurs/$utilisateursParPage)+($qteUtilisateurs%$utilisateursParPage == 0?0:1);
if(isset($_GET['page']))
{
	$page = (int) $_GET['page'];

	if($page > 1 and $page <= $qtePages)
		$debut = ($page -1)*$utilisateursParPage;
	else
		$page = 1;
}
else
	$page = 1;

$utilisateurs = getUsersList($debut, $fin);

if(!empty($utilisateurs))
{
	foreach($utilisateurs as &$utilisateur)
	{
		$utilisateur['name'] = htmlspecialchars($utilisateur['name']);
		$utilisateur['pseudo'] = htmlspecialchars($utilisateur['pseudo']);
	}
}

$page_title = 'Liste des membres';
include_once("view/membres.php");
