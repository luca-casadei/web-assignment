<?php
    require './bootstrap.php';

    $tp["title"] = "SegnaLibro - Carrello";
    $tp["identification"] = "cart";
    if (isUserLoggedIn()){
        if (!isUserVendor()){
            array_push($tp["js"] , "./js/cart.js");
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