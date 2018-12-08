<?php
include_once '../../library/config/dbhandler.php';
include_once '../../model/department.php';

$dbhandler = new DBHandler();
$connection = $dbhandler->getConnection();

$department = new Department($connection);
$response = $department->getAll();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
http_response_code(200);

echo json_encode($response);
?>