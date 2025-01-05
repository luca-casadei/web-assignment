<?php
    require './bootstrap.php';

    if(isUserLoggedIn()){
        $tp["title"] = "SegnaLibro - Ordini";
        $tp["identification"] = "orders";
        $tp["content"] = './pages/orders.php';
    }
    else{
        header("Location: ./login_index.php");
    }

    require './template/base.php';
?>