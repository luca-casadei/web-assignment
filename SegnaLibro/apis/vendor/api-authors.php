<?php
require ('../../bootstrap.php');
if (isUserLoggedIn() && isUserVendor()){
    $authors = $dbh->getAuthors();
    header('Content-Type: application/json');
    echo json_encode($authors);
} else{
    http_response_code("403");
}
?>