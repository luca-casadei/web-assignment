<?php
session_start();
//require_once("utils/functions.php");
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "segnalibro_logic", 3306);
?>