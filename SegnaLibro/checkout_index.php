<?php
require("./bootstrap.php");
$tp["title"] = "SegnaLibro - Checkout";
$tp["identification"] = "checkout";
$tp["content"] = './pages/checkout.php';
$tp["active"] = "checkout";
array_push($tp["js"], "./js/checkout.js");
require("./template/base.php");
?>