<?php
require("../bootstrap.php");
if (isUserLoggedIn()){
    $data = $dbh->getNotificationsOfUUID($_SESSION["userid"],true);
    header('Content-Type: application/json');
    echo json_encode($data);
}
else{
    echo http_response_code(403);
}
?>