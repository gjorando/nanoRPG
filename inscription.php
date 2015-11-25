<?php
include_once("model/sessions.php");

if(isLogged())
	header("Location: ./");
else
{
	
	$page_title="Inscription";
	include_once("view/inscription.php");
}
