<?php 
require_once 'connect/database.php';
require_once 'classes/users.php';
require_once 'classes/general.php';

$users = new Users($db);
$general = new General();

$errors = array();