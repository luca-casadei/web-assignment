<?php
    require './bootstrap.php';
    if (!isset($_SESSION["addcopy"])){
        header("Location: ./index.php");
    }
    define('DIRECT_ACCESS',true);

    $tp["title"] = "SegnaLibro - aggiungi copia";
    $tp["identification"] = "add_copy";
    $tp["content"] = "./pages/vendor/addcopy.php";
    
    array_push($tp["js"], "./js/vendor/addcopy.js","./js/vendor/loadconditions.js");
    require './template/base.php';
?>