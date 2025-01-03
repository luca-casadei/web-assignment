<?php
require ('../../bootstrap.php');
if (isUserLoggedIn() && isUserVendor()){
    $books = $dbh->getBooks();
    header('Content-Type: application/json');
    echo json_encode($books);
} else{
    http_response_code("403");
}
?>