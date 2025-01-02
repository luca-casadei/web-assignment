<?php
require('../bootstrap.php');
$articles = $dbh->getAnnounces();
header('Content-Type: application/json');
echo json_encode($articles);
?>