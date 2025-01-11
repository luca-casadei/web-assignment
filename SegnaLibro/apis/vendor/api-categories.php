<?php
require ('../../bootstrap.php');
$categories = $dbh->getCategories();
header('Content-Type: application/json');
echo json_encode($categories);
?>