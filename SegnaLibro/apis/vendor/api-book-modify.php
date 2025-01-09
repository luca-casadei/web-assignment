<?php
require '../../bootstrap.php';
if (isset($_POST["expandedvendorbook"])){
    $_SESSION["expandedvendorbook"] = $_POST["expandedvendorbook"];
    echo 'SUCCESS';
}
else{
    echo http_response_code(400);
}
?>