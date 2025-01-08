<?php
if(isset($_POST["book"])
&& isset($_POST["author"])
&& isset($_POST["category"])) {
    $book = json_decode($_POST["book"]);
}
?>