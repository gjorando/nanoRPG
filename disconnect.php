<?php
include_once("model/sessions.php");

session_destroy();

header("Location: ./");
