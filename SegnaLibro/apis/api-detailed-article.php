<?php
require '../bootstrap.php';
if (isset($_POST)){
    $_SESSION["expandedarticledata"] = $_POST["expandedarticledata"];
    echo 'SUCCESS';
}
?>