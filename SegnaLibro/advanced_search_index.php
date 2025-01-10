<?php
require("./bootstrap.php");
$tp["title"] = "SegnaLibro - Ricerca avanzata";
$tp["identification"] = "advancedsearch";
$tp["content"] = './pages/advancedsearch.php';
$tp["active"] = "search";
array_push($tp["js"], "./js/loadsearchedarticles.js");
require("./template/base.php");
?>