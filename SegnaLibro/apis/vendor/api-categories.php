<?php
require ('../../bootstrap.php');
if (isUserLoggedIn() && isUserVendor()){
    $categories = $dbh->getCategories();
    header('Content-Type: application/json');
    echo json_encode($categories);
} else{
    http_response_code("403");
}
?>