<?php
if(isset($_POST["book"])
&& isset($_POST["author"])
&& isset($_POST["category"])) {
    $book = json_decode($_POST["book"]);
    $author = json_decode($_POST["author"]);
    $category = json_decode($_POST["category"]);
    $dbh->insertBook($book);
    $dbh->insertAuthor($author);
    $dbh->insertBookAuthor($book, $author);
}
?>