<?php
require("./bootstrap.php");
if (isUserVendor()){
    $tp["title"] = "SegnaLibro - Ordini utente";
    $tp["identification"] = "user_orders";
    $tp["active"] = "user_orders";
    array_push($tp["js"], "./js/vendor/user_orders.js");
    require("./template/base.php");
}
else{
    header("Location: ./index.php");
}
?>