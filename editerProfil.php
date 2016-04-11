<?php
include_once("model/sessions.php");
include_once("model/users.php");

if(!isLogged())
	Header('Location: /');
else
{
	if(!isset($_GET['id']))
		$uid = getUserId(); //Edition de son propre profil
	else if(!($adminMode = isAdmin(getUserId()))) //Si on tente d'éditer le profil d'un-e autre sans être admin
	{
		Header('Location: profil.php?id=' . $_GET['id']);
		exit;
	}
	else //Si on est admin et qu'on s'apprête à modifier un autre profil que le sien
		$uid = $_GET['id'];

	if(!($data = getUserInfoById($uid)))
	{
		header('Location: /');
		exit;
	}

	$ownProfile = $uid == getUserId();
	
	if(isset($_GET['err']))
	{
		$err = "<div id=\"err\" class=\"icon\">";

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
				break;
			case 5:
				$err.= "L'avatar renseigné est trop lourd ! Le fichier doit faire moins de 1Mio";
				break;
			case 6:
				$err.= "Le type d'image est incorrect ! Le fichier doit être un png, un jpef ou un gif.";
				break;
			default: 
				$err.= "Cessez donc de modifier l'URL, petit malandrin !";
		}

		$err.= "</div>";
	}
	else
	{
		$err = "";
	}
	$data['pseudo'] = htmlspecialchars($data['pseudo']);
	$data['name'] = htmlspecialchars($data['name']);
	$data['bio'] = htmlspecialchars($data['bio']);
	
	$avatar = getAvatarPath($data['id'], $data['avatar']);

	$genderValue=(strtolower($data['gender'])=="homme")?1:((strtolower($data['gender'])=="femme")?2:0);

	$page_title = 'Editer mon profil';
	include_once("view/editerProfil.php");
}

