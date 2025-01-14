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
    while (isset($_FILES["imgarticle{$index}"])) {
        $imgCount++;
        $index++;
    }

    $result = $dbh->insertCopy($bookdata, $title, $price, $description, $date, $condition, $imgCount);

    for ($i = 0; $i < count($result); $i++) {
        $filename = $bookdata["EAN"] . "-" . $bookdata["CodiceRegGroup"] . "-" . $bookdata["CodiceEditoriale"] . "-" . $bookdata["CodiceTitolo"] . "-" . $result[$i];
        if (isset($_FILES["imgarticle{$i}"]) && strlen($_FILES["imgarticle{$i}"]["name"]) > 0) {
            $path = __DIR__ . "/../." . IMAGE_PATH;
            list($resultIMG, $msgIMG) = uploadImage($path, $_FILES["imgarticle{$i}"], $filename);
            $imgarticle = $msgIMG;
            $baseName = pathinfo($imgarticle, PATHINFO_FILENAME);
        }
    }

    echo $path;
} else {
    echo http_response_code(400);
}
?>