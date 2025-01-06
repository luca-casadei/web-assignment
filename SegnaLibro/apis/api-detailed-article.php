<?php
require '../bootstrap.php';
if (isset($_POST)){
    $data = file_get_contents('php://input');
    $_SESSION["expandedarticledata"] = $data;
    echo 'SUCCESS';
}
?>