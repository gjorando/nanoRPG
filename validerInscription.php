<?php
include_once("model/sessions.php");

if(empty($_POST['pseudo']) or empty($_POST['mdp']) or empty($_POST['mdp_confirm']) or empty($_POST['email']) or empty($_POST['nom']) or empty($_POST['date_naissance']) or empty($_POST['genre']))
{
	Header('Location: inscription.php?err=1');
}
else
{
	if($_POST['mdp'] != $_POST['mdp_confirm'])
	{
		Header('Location: inscription.php?err=2');
	}
	else
	{
		if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,}$#', $_POST['email']))
		{
			Header('Location: inscription.php?err=3');
		}
		else
		{
			if(strlen($_POST['mdp']) < 10)
			{
				Header('Location: inscription.php?err=4');
			}
			else
			{
				if(strlen($_POST['pseudo']) > 20)
				{
					Header('Location: inscription.php?err=5');
				}
				else
				{
					if(strlen($_POST['nom']) > 40)
					{
						Header('Location: inscription.php?err=6');
					}
					else
					{
						if(!preg_match('#^[0-9]{2}/[0-9]{2}/[0-9]{4}$#')
						{
							Header('Location: inscription.php?err=7');
						}
						else
						{
							$_POST['nom'] = htmlspecialchars($_POST['nom']);
							$_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
							
							$_SESSION['users'][] = array(
									'pseudo' => $_POST['pseudo'],
									'nom' => $_POST['nom'],
									'gender' => $_POST['genre'],
									'email' => $_POST['email'],
									'bio' => '',
									'pswd' => sha1($_POST['mdp']));

							Header('Location: inscriptionValidee.php');
						}
					}
				}
			}	
		}
	}	
}

