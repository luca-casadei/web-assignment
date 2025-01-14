<?php

function uploadImage($path, $image, $filename)
{
    $originalName   = $image["name"];
    $imageFileType  = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    $baseName = $filename;
    $imageName = $baseName . '.' . $imageFileType;
    $fullPath = $path . $imageName;

    $maxKB = 50000;
    $acceptedExtensions = array("jpg", "jpeg", "png");
    $result = 0;
    $msg = "";

    $imageSize = getimagesize($image["tmp_name"]);
    if ($imageSize === false) {
        $msg .= "File caricato non è un'immagine! ";
    }

    if ($image["size"] > $maxKB * 1024) {
        $msg .= "File caricato pesa troppo! (max $maxKB KB). ";
    }

    if (!in_array($imageFileType, $acceptedExtensions)) {
        $msg .= "Estensione non valida. Accettate solo: " . implode(", ", $acceptedExtensions) . ". ";
    }

    if (file_exists($fullPath)) {
        $i = 1;
        do {
            $i++;
            $imageName = $baseName . '_' . $i . '.' . $imageFileType;
            $fullPath  = $path . $imageName;
        } while (file_exists($fullPath));
    }

    if (strlen($msg) === 0) {
        if (!move_uploaded_file($image["tmp_name"], $fullPath)) {
            $msg .= "Errore durante lo spostamento del file caricato.";
        } else {
            $result = 1;
            $msg = $imageName;
        }
    }

    return array($result, $msg);
}

