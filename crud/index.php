<?php
include_once("../model/crudAccess.php");
include_once("../model/sessions.php");
include_once("../model/game_delete.php");

$awaitingCount = countAwaitingDeletionRequests();

$page_title = "Accueil du crud";
include_once("../view/crud/index.php");
