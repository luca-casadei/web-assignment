<?php
    require './bootstrap.php';

    if(isUserLoggedIn() && !isUserVendor()){
        $tp["title"] = "SegnaLibro - Ordini";
        $tp["identification"] = "orders";
        $tp["content"] = './pages/orders.php';
    }
    else{
        header("Location: ./login_index.php");
    }

    require './template/base.php';
?>