<?php
include_once '../../library/config/dbhandler.php';
include_once '../../model/studentDeclarationsBooks.php';

$dbhandler = new DBHandler();
$connection = $dbhandler->getConnection();

$studentDeclarationsBooks = new StudentDeclarationsBooks($connection);
$studentDeclarationsBooks->book_id = $_POST['book_id'];
$studentDeclarationsBooks->declaration_id = $_POST['declaration_id'];
$response = $studentDeclarationsBooks->create();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
http_response_code(200);

echo json_encode($response);
?>