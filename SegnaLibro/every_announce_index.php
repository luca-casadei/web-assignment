<?php
    require "./bootstrap.php";
    if(isUserVendor()){
        $tp["active"] = "every_announce_vendor";
        $tp["identification"] = "everyann";
        array_push($tp["js"], "./js/vendor/loadcopies.js");
        require "./template/base.php";
    }
    else{
        header("Location: ./index.php");
    }
?>