<?php
session_start();

include_once('model/users.php');

/**
 * Retourne vrai si l'id de session actuel existe dans la BDD
 */
function isValidID($n, $p)
{	
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
 * Retourne l'ID de l'utilisateur dont la session est active
 */
function getUserID()
{
	return $_SESSION['session_id'];
}
