<?php

require_once 'bootstrap.php';

$tp["title"] = "SegnaLibro - Home";
$tp["identification"] = "home";
array_push($tp["js"] , "./js/loadarticles.js");
require 'template/base.php';
?>
