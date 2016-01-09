<?php
include_once("model/sessions.php");

if(isLogged())
	header("Location: ./");
else
{	
	$page_title="Connexion";
	include_once("view/connexion.php");
}
