<?php
    require './bootstrap.php';
    if (isUserVendor()){
        header("Location: ./user_order_expanded_index.php");
    }
    if (!isset($_SESSION["orderexpanded"])){
        header("Location: ./index.php");
    }
    define('DIRECT_ACCESS',true);

    $tp["title"] = "SegnaLibro - Dettagli ordine";
    $tp["identification"] = "order_expanded";
    
    array_push($tp["js"], "./js/order_expanded.js");
    require './template/base.php';
?>