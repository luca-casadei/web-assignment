<?php
    require './bootstrap.php';
    if (!isset($_SESSION["userorderexpanded"])){
        header("Location: ./index.php");
    }
    define('DIRECT_ACCESS',true);

    $tp["title"] = "SegnaLibro - Dettagli ordine";
    $tp["identification"] = "user_order_expanded";
    
    array_push($tp["js"], "./js/vendor/user_order_expanded.js");
    require './template/base.php';
?>