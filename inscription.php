<?php
include_once("model/sessions.php");

if(isLogged())
	header("Location: ./");
else
{
	if(isset($_GET['err']))
	{
		$err = "<div id=\"err\" class=\"icon\">";
		switch($_GET['err'])
		{
			case 1:
				$err.= "Merci de compléter tous les champs du formulaire !";
				break;
			case 2:
				$err.= "Les mots de passe ne correspondent pas !";
				break;
			case 3:
				$err.= "L'email entré est incorrect !";
				break;
			case 4:
				$err.= "Le mot de passe doit comporter au moins dix caractères !";
				break;
			case 5:	
				$err.= "Le pseudo ne peut excéder 20 caractères !";
				break;
			case 6:
				$err.= "Le nom complet ne peut excéder 40 caractères !";
				break;
			case 7:
				$err.= "La date doit respecter le format DD/MM/YYYY !";
				break;
			case 8:
				$err.= "Merci d'accepter les conditions générales d'utilisation !";
				break;
			case 9:
				$err.= "Ce pseudo existe déjà dans la base de données !";
				break;
			case 10:
				$err.= "Cette adresse mail existe déjà dans la base de données !";
				break;
			default:
				$err.= "Cessez donc de modifier l'URL, petit malandrin !";
		}
		$err.= "</div>";
	}
	else
		$err='';
					
	$page_title="Inscription";
	include_once("view/inscription.php");
}
