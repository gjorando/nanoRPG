<?php
session_start();

include_once('model/users.php');

if(!isset($_SESSION['users'])) //TODO ersatz de la table users dans la base de données
{
	$_SESSION['users'][0] = array(
			'pseudo' => 'root',
			'nom' => 'Testificate',
			'gender' => 'Homme',
			'email' => 'root@nanorpg.dev',
			'date_naissance' => '01/01/1900',
			'bio' => 'Utilisateur de test',
			'pswd' => sha1('root'),
			'avatar' => true);
}

/**
 * Retourne vrai si l'id de session actuel existe dans la BDD
 */
function isValidID($n, $p)
{
	//TODO interfaçage avec la BDD : tester si l'id correspond, et que le sha1 du mot de passe dans la session correspond à l'utilisateur
	if(($u = getUserInfoById(getUserId())) != null)
		if($u['pswd'] == $p)
			return true;
	return false;
}

/**
 * Retourne vrai si l'utilisateur est connecté, faux sinon
 */
function isLogged()
{
	if(isset($_SESSION['session_id']) AND isset($_SESSION['session_pswd']) AND isValidID($_SESSION['session_id'], $_SESSION['session_pswd']))
	{
		return true;
	}
	else
	{
		unset($_SESSION['session_id']);
		unset($_SESSION['session_pswd']);
		return false;
	}
}

/**
 * Retourne l'ID utilisateur sur la base de l'ID de session
 */
function getUserID()
{
	return $_SESSION['session_id']; //TODO Sans bdd, le session id correspond à l'user id
}
