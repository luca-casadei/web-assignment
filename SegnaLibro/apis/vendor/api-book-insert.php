<?php
require '../../bootstrap.php';
if(isset($_POST["book"])
&& isset($_POST["author"])
&& isset($_POST["category"])
&& isset($_POST["genres"])) {
    $book = json_decode($_POST["book"], true);
    $author = json_decode($_POST["author"], true);
    $category = json_decode($_POST["category"], true);
    $genres = json_decode($_POST["genres"]);

    $status = $dbh->fullyInsertBook($book, $author, $category, $genres);
    echo $status;
} else {
    echo http_response_code(400);
}
?>