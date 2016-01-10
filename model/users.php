<?php

/*
 * Ajoute un utilisateur en base de donnée
 */
function addUser($pseudo, $nom, $genre, $email, $date_naissance, $pswd)
{
	$_SESSION['users'][] = array( //TODO interfaçage avec BDD
			'pseudo' => $pseudo,
			'nom' => $nom,
			'gender' => $genre,
			'email' => $email,
			'date_naissance' => $date_naissance,
			'bio' => '',
			'pswd' => sha1($pswd),
			'avatar' => false);
}

/*
 * Modifie les données utilisateur
 */
function updateUser($id, $pseudo, $nom, $genre, $email, $date_naissance, $bio, $pswd, $hasAvatar)
{
	$uid = ($id == null)?getUserId():$id; //TODO interfaçage BDD

	if($pseudo != null)
		$_SESSION['users'][$uid]['pseudo']= $pseudo;
	if($nom != null)
		$_SESSION['users'][$uid]['nom']= $nom;
	if($genre != null)
		$_SESSION['users'][$uid]['gender']= $genre;
	if($email != null)
		$_SESSION['users'][$uid]['email']= $email;
	if($bio != null)
		$_SESSION['users'][$uid]['bio']= $bio;
	if($date_naissance != null)
		$_SESSION['users'][$uid]['date_naissance']= $date_naissance;
	if($pswd != null)
		$_SESSION['users'][$uid]['pswd']= sha1($pswd);
	$_SESSION['users'][$uid]['avatar']= $hasAvatar; 
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
					'date_naissance' => $data['date_naissance'],
					'bio' => $data['bio'],
					'pswd' => $data['pswd'],
					'avatar' => $data['avatar']);

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
					'date_naissance' => $data['date_naissance'],
					'bio' => $data['bio'],
					'pswd' => $data['pswd'],
					'avatar' => $data['avatar']);

	}
	return null;
}
