<?php
require ('../../bootstrap.php');
if(isset($_POST["addcopy"])){
    $_SESSION["addcopy"] = $_POST["addcopy"];
    echo 'SUCCESS';
}
else if(isset($_POST["newCopy"])) {
    $bookdata = json_decode($_SESSION["addcopy"],true);
    $decoded = json_decode($_POST["newCopy"], true);
    $title = $decoded["Titolo"];
    $date = date("Y-m-d");
    $price = $decoded["Prezzo"];
    $description = $decoded["Descrizione"];
    $condition = $decoded["Condizione"];
    $result = $dbh->insertCopy($bookdata, $title, $price, $description, $date, $condition);
    echo $result;
} else {
    echo http_response_code(400);
}
?>