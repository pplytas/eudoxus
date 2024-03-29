<?php
include_once '../../library/config/dbhandler.php';
include_once '../../model/student.php';

$dbhandler = new DBHandler();
$connection = $dbhandler->getConnection();

$student = new Student($connection);
$student->id = $_POST['id'];
$student->delete();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
http_response_code(200);
?>