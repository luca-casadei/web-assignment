<?php
require("./bootstrap.php");
if (isUserLoggedIn()){
    $tp["title"] = "SegnaLibro - Notifiche";
    $tp["identification"] = "notifications";
    array_push($tp["js"], "./js/loadnotifications.js");
    require('./template/base.php');
}
else{
    header("Location: ./login_index.php");
}
?>