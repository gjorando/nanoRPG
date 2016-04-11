<?php
include_once("../model/crudAccess.php");
include_once("../model/sessions.php");
include_once("../model/game_delete.php");
include_once("../model/games.php");
include_once("../model/libraries.php");
include_once("../model/chat.php");

if(empty($_POST))
	header('Location: ./');
else if(!isset($_GET['id']))
	header('Location: ./');
else if(!($req = getDeletionRequestById($_GET['id'])))
	header('Location: ./');
else if(strlen($_POST['decision']) < 40)
	Header('Location: traiterDemandeSuppressionJeu.php?id=' . $_GET['id'] . '&err=1');
else if(empty($_POST['action']))
	Header('Location: traiterDemandeSuppressionJeu.php?id=' . $_GET['id'] . '&err=2');
else if(($_POST['action'] == 'migrate-action') && empty($_POST['id-new']))
	Header('Location: traiterDemandeSuppressionJeu.php?id=' . $_GET['id'] . '&err=3');
else if(($_POST['action'] == 'migrate-action') && !empty($_POST['id-new']) && !($newUser = getUserInfoById($_POST['id-new'])))
	Header('Location: traiterDemandeSuppressionJeu.php?id=' . $_GET['id'] . '&err=3');
else
{
	$req['name'] = htmlspecialchars($req['name']);
	$req['pseudo'] = htmlspecialchars($req['pseudo']);
	
	switch($_POST['action'])
	{
		case 'delete-action':
			deleteGame($req['id_game']);
			$actionMessage = $req['name'] . ' a été supprimé définitivement de la base de données !';
			$actionMessageChat = $actionMessage;
			break;
		case 'migrate-action':
			migrateGame($req['id_game'], $_POST['id-new']);
			$actionMessage = $req['name'] . ' appartient désormais à <a href="/profil.php?id=' . $_POST['id-new'] . '"><span class="' . ($newUser['admin']?'adminP':'userP') . '">' . $newUser['pseudo'] . '</span></a> !';
			$actionMessageChat = $req['name'] . ' appartient désormais à ' . $newUser['pseudo'] . ' !';
			break;
		case 'nothing-action':
			$actionMessage = 'Aucune action spécifique n\'a été faite !';
			$actionMessageChat = $actionMessage;
			break;
		default:
			$actionMessage = "Une erreur innattendue s'est produite !"; //Normalement on ne devrait jamais entrer ici... Normalement... #développeurConfiant
	}

	closeDeletionRequest($_GET['id'], $_POST['decision'], getUserId());

	$selfDecision = (getUserId() == $req['id_requester']);
	
	if(!$selfDecision)
	{
		sendMessage("Bonjour ! Vous avez récemment fait une requête demandant la suppression de " . $req['name'] . ", pour la raison suivante : " . $req['reason'] . ".\nJe l'ai traitée, veuillez donc trouver dans le message suivant la résolution de cette requête.", getUserId(), $req['id_requester']);
		sendMessage("Action entreprise : " . $actionMessageChat . "\nMessage : " . $_POST['decision'], getUserId(), $req['id_requester']);
	}
	
	$_POST['decision'] = nl2br(htmlspecialchars($_POST['decision']));


	$page_title = "Traitement de la requête n°" . $_GET['id'];
	include_once("../view/crud/validerTraitementDemandeSuppressionProjet.php");
}
