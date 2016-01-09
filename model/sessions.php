<?php
session_start();
if(!isset($_SESSION['users']))
{
	$_SESSION['users'][0] = array(
		'pseudo' => 'root',
		'gender' => 'homme',
		'email' => 'root@nanorpg.dev',
		'bio' => 'Utilisateur de test',
		'pswd' => sha1('root'));
}

/**
 * Retourne vrai si l'id de session actuel existe dans la BDD
 */
function isValidID($n, $p)
{
	return true; //TODO interfaçage avec la BDD : tester si l'id correspond, et que le sha1 du mot de passe dans la session correspond à l'utilisateur
}

/**
 * Retourne vrai si l'utilisateur est connecté, faux sinon
 */
function isLogged()
{
	if(isset($_SESSION['session_id']) AND isset($_SESSION['session_pswd'] AND isValidID($_SESSION['session_id'], $_SESSION['session_pswd']))
	{
		return true;
	}
	else
	{
		return false;
	}
}
