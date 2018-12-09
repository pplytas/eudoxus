<?php
include_once '../../library/config/dbhandler.php';
include_once '../../model/secretaryDeclarationsBooks.php';

$dbhandler = new DBHandler();
$connection = $dbhandler->getConnection();

$secretaryDeclarationsBooks = new SecretaryDeclarationsBooks($connection);
$response =$secretaryDeclarationsBooks->getAll();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
http_response_code(200);

echo json_encode($response);
?>