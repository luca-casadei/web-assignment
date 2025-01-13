<?php
require ('../../bootstrap.php');
require ('../../utils/images.php');
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


    if(isset($_FILES["imgarticle"]) && strlen($_FILES["imgarticle"]["name"])>0){
        $path = __DIR__ . "/../." . IMAGE_PATH;
        list($resultIMG, $msgIMG) = uploadImage($path, $_FILES["imgarticle"], $bookdata);
        $imgarticle = $msgIMG;

    }

    $result = $dbh->insertCopy($bookdata, $title, $price, $description, $date, $condition, [$imgarticle]);
    
    echo $imgarticle;
} else {
    echo http_response_code(400);
}
?>