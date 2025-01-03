<?php

require_once 'bootstrap.php';

$tp["title"] = "SegnaLibro - Home";
$tp["identification"] = "home";
if (isUserLoggedIn()){
    if (!isUserVendor()){
        array_push($tp["js"] , "./js/loadarticles.js");
    }
}else{
    array_push($tp["js"] , "./js/loadarticles.js");
}
require 'template/base.php';
?>
