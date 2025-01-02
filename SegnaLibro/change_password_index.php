<?php
    require './bootstrap.php';

    if(isUserLoggedIn()){
        define("DIRECT_ACCESS", false);
        $tp["title"] = "SegnaLibro - Cambio password";
        $tp["identification"] = "change_password";
        $tp["content"] = './pages/change_password.php';
    }
    else{
        header("Location: ./login_index.php");
    }

    require './template/base.php';
?>