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
