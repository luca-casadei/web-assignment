<?php
require "../../bootstrap.php";
if(isset($_POST["bofcopies"])){
    $_SESSION["bofcopies"] = $_POST["bofcopies"];
    echo 'SUCCESS';
}
else{
    echo http_response_code(400);
}
?>