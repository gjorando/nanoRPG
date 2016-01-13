<?php

/*
 * Prend la date au format DD/MM/YYYY pour retourner YYYY-MM-DD (format français->format sql)
 */
function prepareDate($myDate)
{
	$day = substr($myDate, 0, 2);
	$month = substr($myDate, 3, 2);
	$year = substr($myDate, 6);
	return $year . '-' . $month . '-' . $day;
}

/*
 * Prépare le chemin d'accès de l'avatar sur la base de l'id et de l'extension
 */
function getAvatarPath($id, $extension)
{
	return '/img/' . ($extension!=null?('data/avatars/' . $id . '.' . $extension):'default_avatar.png');
}

/*
 * Fonction de débogage
 */
function print_var($v)
{
	echo '<pre>';
	print_r($v);
	echo '</pre>';
}
