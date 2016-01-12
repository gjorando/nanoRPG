<?php
include_once("model/sessions.php");
include_once("model/users.php");

if(!isLogged())
	Header('Location: /');
else
{
	if(isset($_GET['err']))
	{
		$err = "<div id=\"err\">";

		switch($_GET['err'])
		{
			case 1:
				$err.= "L'email entré est incorrect !";
				break;
			case 2:
				$err.= "Merci d'entrer un nom complet de moins de 40 caractères !";
				break;
			case 3:
				$err.= "Les nouveaux mots de passe ne correspondent pas !";
				break;
			case 4:
				$err.= "Le nouveau mot de passe doit comporter au moins dix caractères !";
			default: 
				$err.= "Cessez donc de modifier l'URL, petit malandrin !";
		}

		$err.= "</div>";
	}
	else
	{
		$err = "";
	}
	$data = getUserInfoById(getUserId());
	$data['pseudo'] = htmlspecialchars($data['pseudo']);
	$data['nom'] = htmlspecialchars($data['nom']);
	$data['bio'] = htmlspecialchars($data['bio']);

	$genderValue=(strtolower($data['gender'])=="homme")?1:((strtolower($data['gender'])=="femme")?2:0);
	$page_title = 'Editer mon profil';
	include_once("view/editerProfil.php");
}

