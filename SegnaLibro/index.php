<?php

require_once 'bootstrap.php';

$tp["title"] = "SegnaLibro - Home";
$tp["active"] = "home";
if (isUserLoggedIn()){
    if (!isUserVendor()){
        array_push($tp["js"] , "./js/loadarticles.js");
        $tp["identification"] = "homeuser";
    }
    else{
        array_push($tp["js"], "./js/vendor/loadbooks.js");
        $tp["identification"] = "homevendor";
    }
}else{
    array_push($tp["js"] , "./js/loadarticles.js");
    $tp["identification"] = "homeuser";
}
require 'template/base.php';
?>
