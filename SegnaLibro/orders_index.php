<?php
    require './bootstrap.php';

    if(isUserLoggedIn() && !isUserVendor()){
        define("DIRECT_ACCESS", true);
        $tp["title"] = "SegnaLibro - Ordini";
        $tp["identification"] = "orders";
        $tp["content"] = './pages/orders.php';
        $tp["active"] = "orders";
    }
    else{
        header("Location: ./login_index.php");
    }

    require './template/base.php';
?>