<?php
session_start();
define("IMAGE_PATH", "./images/upload/");
require("utils/functions.php");
require("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "segnalibro_logic", 3306);
$tp["js"] = array('./js/navigation.js');
?>