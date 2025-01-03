<?php
    require './bootstrap.php';

    $tp["title"] = "SegnaLibro - Carrello";
    $tp["identification"] = "cart";
    if (isUserLoggedIn()) {
        $tp["content"] = './pages/cart.php';
        define("DIRECT_ACCESS", false);
    } else {
        header('Location: ./login_index.php');
    }
    array_push($tp["js"], "./js/cart.js");

    require './template/base.php';
?>