<?php
session_start();

$PROJECT_ROOT = dirname(__DIR__) . '/'; //Pour l'accès relatif

include_once($PROJECT_ROOT . 'model/users.php');
include_once($PROJECT_ROOT . "model/tech.php");

/**
 * Retourne vrai si l'id associé au mot de passe entrés en paramètre existe dans la BDD
 */
function isValidID($n, $p)
{	
	if(($u = getUserInfoById($n)) != null)
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
 * Retourne l'ID de l'utilisateur dont la session est active
 */
function getUserID()
{
	return isLogged()?$_SESSION['session_id']:null;
}
