<?php
    require './bootstrap.php';

    if(isUserLoggedIn()){
        define("DIRECT_ACCESS", false);
        $tp["title"] = "SegnaLibro - Ordini";
        $tp["identification"] = "orders";
        $tp["content"] = './pages/orders.php';
    }
    else{
        header("Location: ./login_index.php");
    }

    require './template/base.php';
?>