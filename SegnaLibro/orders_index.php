<?php
    require './bootstrap.php';

    define("DIRECT_ACCESS", true);
    $tp["title"] = "SegnaLibro - Ordini";
    $tp["identification"] = "orders";
    $tp["active"] = "orders";
    if (isUserLoggedIn()){
        if (!isUserVendor()){
            array_push($tp["js"] , "./js/orders.js");
        }
        else{
            header("Location: ./index.php");
        }
    }
    else{
        header("Location: ./index.php");
    }
    require './template/base.php';
?>