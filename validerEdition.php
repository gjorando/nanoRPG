<?php
include_once("model/sessions.php");
include_once("model/users.php");

if(!isLogged())
	Header('Location: /');
if(!isset($_GET['id']))
	Header('Location: /');
else if((getUserId() != $_GET['id']) && !isAdmin(getUserId()))
	Header('Location: /');
else if(!($data = getUserInfoById($_GET['id'])))
	Header('Location: /');
if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,}$#', $_POST['email']))
	Header('Location: editerProfil.php?id=' . $_GET['id'] . '&err=1');
else if(strlen($_POST['name']) > 40 or strlen($_POST['name']) == 0)
	Header('Location: editerProfil.php?id=' . $_GET['id'] . '&err=2');
else if(!empty($_POST['mdp']) and $_POST['mdp'] != $_POST['mdp_confirm'])
	Header('Location: editerProfil.php?id=' . $_GET['id'] . '&err=3');
else if(!empty($_POST['mdp']) && $_POST['mdp'] < 10)
	Header('Location: editerProfil.php?id=' . $_GET['id'] . '&err=4');
else
{
	$noUploadErr = true;	
	
	$avatarSet=$data['avatar'];
	
	if(isset($_FILES['avatar']) and $_FILES['avatar']['error'] == 0)
	{
		$uploadType = $_FILES['avatar']['type'];

		if($_FILES['avatar']['size'] > 1048576) //taille supérieure à 1Mio
		{
			Header('Location: editerProfil.php?id=' . $_GET['id'] . '&err=5');
			$noUploadErr = false;
		}
		else if(!in_array($uploadType, Array("image/png", "image/jpeg", "image/gif")))
		{
			Header('Location: editerProfil.php?id=' . $_GET['id'] . '&err=6');
			$noUploadErr = false;
		}
		else
		{
			//On déplace l'image dans son emplacement définitif
			$avatarPath = 'img/data/avatars/' . $_GET['id'] . '.' . pathinfo($_FILES['avatar']['name'])['extension'];
			$oldAvatar = $avatarSet?'img/data/avatars/' . $_GET['id'] . '.' . $avatarSet:false;
			$avatarSet = move_uploaded_file($_FILES['avatar']['tmp_name'], $avatarPath)?pathinfo($_FILES['avatar']['name'])['extension']:$avatarSet;
			if($oldAvatar) //Suppression si besoin de l'ancienne image
			{
				unlink($oldAvatar);
			}	

			//Opération de resizing/rognage
			switch($uploadType) //On ouvre l'image selon son type
			{
				case 'image/png':
					$src = imagecreatefrompng($avatarPath);
					break;
				case 'image/gif':
					$src = imagecreatefromgif($avatarPath);
					break;
				case 'image/jpeg':
					$src = imagecreatefromjpeg($avatarPath);
					break;
			}

			if($src)
			{
				$imageLarge = imagesx($src)>imagesy($src)?true:false; //On vérifie si elle est en portrait ou en paysage

				if(($imageLarge?imagesx($src):imagesy($src)) > 256)
				{
					$ratio = imagesx($src)/imagesy($src);
					$dim = (int) ($ratio > 1?256/$ratio:256*$ratio);
					$dimX = $imageLarge?256:$dim;
					$dimY = $imageLarge?$dim:256;
					$tmp = imagecreatetruecolor($dimX, $dimY);
					imagecopyresampled($tmp, $src, 0, 0, 0, 0, $dimX, $dimY, imagesx($src), imagesy($src));
				}
				else
				{
					$tmp = $src;
				}

				$tailleImage = imagesx($tmp)>imagesy($tmp)?(imagesy($tmp)<256?imagesy($tmp):256):(imagesx($tmp)<256?imagesx($tmp):256); //On calcule les dimensions de rognage

				$dest = imagecreatetruecolor($tailleImage, $tailleImage); //On crée l'image finale

				imagecopy($dest, $tmp, 0, 0, 0, 0, $tailleImage, $tailleImage); //On fait le rognage

				imagedestroy($tmp); //On décharge l'ancienne image

				switch($uploadType) //On sauvegarde la nouvelle image
				{
					case 'image/png':
						imagepng($dest, $avatarPath);
						break;
					case 'image/gif':
						imagegif($dest, $avatarPath);
						break;
					case 'image/jpeg':
						imagejpeg($dest, $avatarPath);
						break;
				}
			}
		}
	}

	if($noUploadErr)
	{
		updateUser($_GET['id'], null, $_POST['name'], $_POST['genre'], $_POST['email'], null, $_POST['bio'], (!empty($_POST['mdp'])?$_POST['mdp']:null), $avatarSet);
		
		Header('Location: profil.php?id=' . $_GET['id']);
	}
}
