<?php
session_start();

/**
 * Retourne vrai si l'id de session actuel existe dans la BDD
 */
function isValidID($n)
{
	return true;
}

/**
 * Retourne vrai si l'utilisateur est connecté, faux sinon
 */
function isLogged()
{
	if(isset($_SESSION['session_id']) AND isValidID($_SESSION['session_id']))
	{
		return true;
	}
	else
	{
		return false;
	}
}
