<?php
require ('../../bootstrap.php');

if (isUserLoggedIn() && isUserVendor()) {
    if (isset($_POST['category'])) {
        $categoryId = $_POST['category'];
        $genres = $dbh->getCategoryGenres($categoryId);
        header('Content-Type: application/json');
        echo json_encode($genres);
    } else {
        http_response_code(400);
    }
} else {
    http_response_code(403);
}
?>
