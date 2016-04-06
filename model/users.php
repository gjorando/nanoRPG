<?php

include_once($PROJECT_ROOT . 'model/connectBDD.php');
include_once($PROJECT_ROOT . 'model/sessions.php');

/*
 * Ajoute un utilisateur en base de donnée
 */
function addUser($pseudo, $nom, $genre, $email, $date_naissance, $pswd)
{
	global $bdd;

	$req = $bdd->prepare('INSERT INTO users(pseudo, name, gender, email, pswd, birth) VALUES(:pseudo, :name, :gender, :email, :pswd, :birth)');

	$req->execute(array(
			'pseudo' => $pseudo,
			'name' => $nom,
			'gender' => $genre,
			'email' => $email,
			'pswd' => sha1($pswd),
			'birth' => $date_naissance));
}

/*
 * Modifie les données utilisateur
 */
function updateUser($id, $pseudo, $nom, $genre, $email, $date_naissance, $bio, $pswd, $hasAvatar)
{
	global $bdd;
	
	$uid = ($id == null)?getUserId():$id;

	$reqString = 'UPDATE users SET ';
	$putComma = false;
	$reqArray = array();

	if($pseudo != null)
	{
		$reqString.= ' pseudo = :pseudo';
		$putComma = true;
		$reqArray['pseudo'] = $pseudo;
	}
	if($nom != null)
	{
		$reqString.= ($putComma?',':'') . ' name = :name';
		$putComma = true;
		$reqArray['name'] = $nom;
	}
	if($genre != null)
	{
		$reqString.= ($putComma?',':'') . ' gender = :gender';
		$putComma = true;
		$reqArray['gender'] = $genre;
	}
	if($email != null)
	{
		$reqString.= ($putComma?',':'') . ' email = :email';
		$putComma = true;
		$reqArray['email'] = $email;
	}
	if($bio != null)
	{
		$reqString.= ($putComma?',':'') . ' bio = :bio';
		$putComma = true;
		$reqArray['bio'] = $bio;
	}
	if($date_naissance != null)
	{
		$reqString.= ($putComma?',':'') . ' birth = :birth';
		$putComma = true;
		$reqArray['birth'] = $date_naissance;
	}
	if($pswd != null)
	{
		$reqString.= ($putComma?',':'') . ' pswd = :pswd';
		$putComma = true;
		$reqArray['pswd'] = sha1($pswd);
	}
	$reqString.= ($putComma?',':'') . ' avatar = :avatar';
	$reqArray['avatar'] = $hasAvatar;
	
	$reqString.= ' WHERE id = :id';
	$reqArray['id'] = $uid;

	$req = $bdd->prepare($reqString);
	$req->execute($reqArray);
}

/*
 * Vérifie si l'id utilisateur est un id valide (existant) : retourne le pseudo correspondant si c'est le cas
 */
function isExistingId($id)
{
	global $bdd;
	
	$req = $bdd->prepare('SELECT pseudo FROM users WHERE id = :id');
	$req->execute(array('id' => $id));

	$res = $req->fetch(PDO::FETCH_COLUMN);

	return $res?$res:false;
}

/*
 * Vérifie si le pseudo existe ou pas dans la BDD
 */
function isExistingPseudo($pseudo)
{
	global $bdd;
	
	$req = $bdd->prepare('SELECT pseudo FROM users WHERE LOWER(pseudo) = :pseudo');
	$req->execute(array('pseudo' => strtolower($pseudo)));

	$pseudos = $req->fetch(PDO::FETCH_COLUMN);

	return $pseudos?true:false;
}

/*
 * Vérifie si le mail existe ou pas dans la BDD
 */
function isExistingEmail($email)
{
	global $bdd;
	
	$req = $bdd->prepare('SELECT email FROM users WHERE LOWER(email) = :email');
	$req->execute(array('email' => strtolower($email)));

	$emails = $req->fetch(PDO::FETCH_COLUMN);

	return $emails?true:false;
}

/*
 * Récupère les infos utilisateurs sur la base du pseudo
 */
function getUserInfoByPseudo($pseudo)
{
	global $bdd;

	$req = $bdd->prepare('SELECT id, pseudo, name, gender, bio, email, pswd, DATE_FORMAT(birth, \'%d/%m/%Y\') AS birth, avatar, admin FROM users WHERE LOWER(pseudo) = :pseudo');
	$req->execute(array('pseudo' => strtolower($pseudo)));
	$userInfo = $req->fetch();
	
	return $userInfo;
}

/*
 * Récupère les infos utilisateurs sur la base de l'id
 */
function getUserInfoById($id)
{
	global $bdd;

	$req = $bdd->prepare('SELECT id, pseudo, name, gender, bio, email, pswd, DATE_FORMAT(birth, \'%d/%m/%Y\') AS birth, avatar, admin FROM users WHERE id = :id');
	$req->execute(array('id' => $id));
	$userInfo = $req->fetch();
	
	return $userInfo;
}

/*
 * Récupère la liste des membres
 */
function getUsersList($debut=NULL, $limite=NULL)
{
	global $bdd;

	$reqString = 'SELECT id, pseudo, name, avatar, admin FROM users';

	if($debut!=null or  $limite!=null)
	{
		$debut = (int) $debut;
		$limite = (int) $limite;
		$reqString.= ' LIMIT :begin, :limit';
	}

	$req = $bdd->prepare($reqString);
	
	if ($debut != null or $limite != null)
	{
		$req->bindParam('begin', $debut, PDO::PARAM_INT);
		$req->bindParam('limit', $limite, PDO::PARAM_INT);
	}

	$req->execute();

	return $req->fetchAll();
}

/*
 * Récupère le nombre d'utilisateurs
 */
function getUsersCount()
{
	global $bdd;

	$req = $bdd->query('SELECT COUNT(id) FROM users');
	$usersCount = $req->fetch()[0];
	return $usersCount;
}

/*
 * Retourne vrai si l'user est admin
 */
function isAdmin($id)
{
	global $bdd;

	$req = $bdd->prepare('SELECT admin FROM users WHERE id = :id');
	$req->execute(array('id' => (int)$id));
	return $req->fetch()[0]==1?true:false;
}
