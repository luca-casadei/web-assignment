<?php
require '../bootstrap.php';
if (isset($_POST)){
    $data = file_get_contents('php://input');
    $_SESSION["expandedarticledata"] = $data;
}
$info = json_decode($_SESSION["expandedarticledata"],true);
$numero_copia = $info["NumeroCopia"];
$ean = $info["EAN"];
$codice_reg_group = $info["CodiceRegGroup"];
$codice_editoriale = $info["CodiceEditoriale"];
$codice_titolo = $info["CodiceTitolo"];
$images = $dbh->getBookImages($numero_copia, $ean, $codice_reg_group, $codice_editoriale, $codice_titolo);
header('Content-Type: application/json');
echo json_encode($images);
?>