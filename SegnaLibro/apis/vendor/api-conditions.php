<?php
require ('../../bootstrap.php');
$conditions = $dbh->getConditions();
header('Content-Type: application/json');
echo json_encode($conditions);
?>