<?php
include_once("model/sessions.php");

//session_destroy(); //TODO déconnexion avec BDD, sans BDD il faut procéder autrement
unset($_SESSION['session_pswd']);

header("Location: ./");
