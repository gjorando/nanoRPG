<?php
$sgbdr='mysql';
$bddHost='localhost';
$bddBase='nanorpg';
$bddUser='root';
$bddPassword='root';

try
{
	$bdd = new PDO($sgbdr . ':host=' . $bddHost . ';dbname=' . $bddBase . ';charset=utf8', $bddUser, $bddPassword);
}
catch(Exception $e)
{	
	die($e->getMessage());
}
