<?php

/*
 * Ajoute un utilisateur en base de donnée
 */
function addUser($pseudo, $nom, $genre, $email, $pswd)
{
	$_SESSION['users'][] = array( //TODO intergaçage avec BDD
			'pseudo' => $pseudo,
			'nom' => $nom,
			'gender' => $genre,
			'email' => $email,
			'bio' => '',
			'pswd' => sha1($pswd));
}

/*
 * Vérifie si le pseudo existe ou pas dans la BDD
 */
function isExistingPseudo($pseudo)
{
	foreach($_SESSION['users'] as $user) //TODO interfaçage avec BDD
		if($user['pseudo'] == $pseudo)
			return true;
	return false;
}

/*
 * Vérifie si le mail existe ou pas dans la BDD
 */
function isExistingEmail($email)
{
	foreach($_SESSION['users'] as $user) //TODO interfaçage avec BDD
		if($user['email'] == $email)
			return true;
	return false;
}
