<?php
include_once("model/sessions.php");
include_once("model/users.php");

if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,}$#', $_POST['email']))
	Header('Location: editerProfil.php?err=1');
else if(strlen($_POST['name']) > 40 or strlen($_POST['name']) == 0)
	Header('Location: editerProfil.php?err=2');
else if(!empty($_POST['mdp']) and $_POST['mdp'] != $_POST['mdp_confirm'])
	Header('Location: editerProfil.php?err=3');
else if(!empty($_POST['mdp']) && $_POST['mdp'] < 10)
	Header('Location: editerProfil.php?err=4');
else
{
	$avatarSet=getUserInfoById(getUserId())['avatar'];

	if(isset($_FILES['avatar']) and $_FILES['avatar']['error'] == 0)
	{
		if($_FILES['avatar']['size'] > 1048576) //taille supérieure à 1Mio
			Header('Location: editerProfil.php?err=5');
		else
		{
			$types = Array("image/png");

			if(!in_array($_FILES['avatar']['type'], $types))
				Header('Location: editerProfil.php?err=6');
			else
			{
				//On déplace l'image dans son emplacement définitif
				$avatarPath = 'img/data/avatars/' . getUserId() . '.' . pathinfo($_FILES['avatar']['name'])['extension'];
				$avatarSet = move_uploaded_file($_FILES['avatar']['tmp_name'], $avatarPath)?pathinfo($_FILES['avatar']['name'])['extension']:$avatarSet;
				
				//Opération de resizing/rognage
				$src = imagecreatefrompng($avatarPath); //On ouvre l'image
				$imageLarge = imagesx($src)>imagesy($src)?true:false; //On vérifie si elle est en portrait ou en paysage
				if(($imageLarge?imagesx($src):imagesy($src)) > 256)
					$src = $imageLarge?imagescale($src, 256):imagescale($src, -1, 256); //On change son échelle selon les besoins, pour réduire sa plus grande dimension à 256px
				$tailleImage = imagesx($src)>imagesy($src)?(imagesy($src)<256?imagesy($src):256):(imagesx($src)<256?imagesx($src):256); //On calcule les dimensions de rognage
				$dest = imagecreatetruecolor($tailleImage, $tailleImage); //On crée l'image finale
				imagecopy($dest, $src, 0, 0, 0, 0, $tailleImage, $tailleImage); //On fait le rognage
				imagedestroy($src); //On décharge l'ancienne image
				imagepng($dest, $avatarPath); //On sauvegarde la nouvelle
			}
		}
	}
	updateUser(null, null, $_POST['name'], $_POST['genre'], $_POST['email'], null, $_POST['bio'], (!empty($_POST['mdp'])?$_POST['mdp']:null), $avatarSet);
	Header('Location: profil.php');
}
