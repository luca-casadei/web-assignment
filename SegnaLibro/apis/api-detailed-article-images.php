<?php
require '../bootstrap.php';
$bd = json_decode($_SESSION["expandedarticledata"],true);
$ean = $bd["EAN"];
$cod_reg_group = $bd["CodiceRegGroup"];
$cod_editoriale = $bd["CodiceEditoriale"];
$codice_titolo = $bd["CodiceTitolo"];
$ncopia = $bd["NumeroCopia"];
$images = $dbh->getBookImages($ncopia, $ean, $cod_reg_group, $cod_editoriale, $codice_titolo);
echo json_encode($images);
?>