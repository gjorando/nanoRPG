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

/*
 * Récupère les infos utilisateurs sur la base du pseudo
 */
function getUserInfoByPseudo($pseudo)
{
	//TODO interfaçage avec la base de données
	foreach($_SESSION['users'] as $id => $data)
	{
		if($pseudo == $data['pseudo'])
			return array(
					'id' => $id,
					'pseudo' => $data['pseudo'],
					'nom' => $data['nom'],
					'gender' => $data['gender'],
					'email' => $data['email'],
					'bio' => $data['bio'],
					'pswd' => $data['pswd']);

	}
	return null;
}

/*
 * Récupère les infos utilisateurs sur la base de l'id
 */
function getUserInfoById($id)
{
	//TODO interfaçage avec la base de données
	foreach($_SESSION['users'] as $key => $data)
	{
		if($key == $id)
			return array(
					'id' => $key,
					'pseudo' => $data['pseudo'],
					'nom' => $data['nom'],
					'gender' => $data['gender'],
					'email' => $data['email'],
					'bio' => $data['bio'],
					'pswd' => $data['pswd']);

	}
	return null;
}
