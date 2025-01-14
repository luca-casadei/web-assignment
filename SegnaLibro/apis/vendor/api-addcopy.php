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

    $index = 0;
    $imgCount = 0;
    $fileExtensions = [];
    while (isset($_FILES["imgarticle$index"])) {
        $lastDotIndex = strrpos($_FILES["imgarticle$index"]["name"], '.');
        $fileExt = substr($_FILES["imgarticle$index"]["name"], $lastDotIndex);
        array_push($fileExtensions, $fileExt);
        $imgCount++;
        $index++;
    }

    $result = $dbh->insertCopy($bookdata, $title, $price, $description, $date, $condition, $fileExtensions);

    $path = __DIR__ . "/../." . IMAGE_PATH;
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }

    for ($i = 0; $i < $imgCount; $i++) {
        $filename = $bookdata["EAN"] . "-" . $bookdata["CodiceRegGroup"] . "-" . $bookdata["CodiceEditoriale"] . "-" . $bookdata["CodiceTitolo"] . "-" . $result[$i];
        if (isset($_FILES["imgarticle$i"]) && strlen($_FILES["imgarticle$i"]["name"]) > 0) {
            $path = __DIR__ . "/../." . IMAGE_PATH;
            list($resultIMG, $msgIMG) = uploadImage($path, $_FILES["imgarticle$i"], $filename);
        }
    }
    
    echo json_encode($fileExtensions);
} else {
    echo http_response_code(400);
}
?>