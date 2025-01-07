<?php
require '../bootstrap.php';
if (isset($_POST)){
    $data = file_get_contents(filename: 'php://input');
    $_SESSION["expandedbookdata"] = $data;
    echo 'SUCCESS';
}
?>