<?php
include_once("model/sessions.php");
include_once("model/users.php");

if(!isLogged())
	header("Location: ./");
else
{
	if(isset($_GET['err']))
	{
		$err = "<div id=\"err\">";
		switch($_GET['err'])
		{
			case 1:
				$err.= "Merci de compléter tous les champs du formulaire !";
				break;
			case 2:
				$err.= "Le nom doit avoir une longueur inférieur ou égale à 60 caractères !";
				break;
			default:
				$err.= "Cessez donc de modifier l'URL, petit malandrin !";
		}
		$err.= "</div>";
	}
	else
		$err='';
					
	$page_title="Nouveau projet";
	include_once("view/nouveauProjet.php");
}
