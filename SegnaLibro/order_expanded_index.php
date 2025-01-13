<?php
    require './bootstrap.php';
    if (!isset($_SESSION["orderexpanded"])){
        header("Location: ./index.php");
    }
    define('DIRECT_ACCESS',true);

    $tp["title"] = "SegnaLibro - dettagli ordine";
    $tp["identification"] = "order_expanded";
    
    array_push($tp["js"], "./js/order_expanded.js");
    require './template/base.php';
?>