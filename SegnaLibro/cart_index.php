<?php
    require './bootstrap.php';

    $tp["title"] = "SegnaLibro - Carrello";
    $tp["identification"] = "cart";
    if (isUserLoggedIn()){
        if (!isUserVendor()){
            array_push($tp["js"] , "./js/cart.js");
        }
    }
    require './template/base.php';
?>