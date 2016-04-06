<?php

include_once('../model/sessions.php');

//Inclure cette page dans toutes les pages du crud permet d'éviter un accès si l'utilisateur n'est pas connecté ou n'est pas un admin
if(!isAdmin(getUserId()))
{
	header($_SERVER["SERVER_PROTOCOL"] . ' 403 Forbidden');
	include('../Forbidden.php');
	exit;
}
