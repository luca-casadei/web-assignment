<?php

require_once 'bootstrap.php';

$tp["title"] = "SegnaLibro - Home";
$tp["identification"] = "home";
$tp["content"] = './pages/home.php';
$tp["js"] = array("./js/script.js","./js/loadarticles.js");

require 'template/base.php';
?>
