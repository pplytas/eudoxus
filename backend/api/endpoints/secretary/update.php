<?php
include_once '../../library/config/dbhandler.php';
include_once '../../model/secretary.php';

$dbhandler = new DBHandler();
$connection = $dbhandler->getConnection();

$secretary = new Secretary($connection);
$secretary->id = $_POST['id'];
$secretary->name = $_POST['name'];
$secretary->surname = $_POST['surname'];
$secretary->department_id = $_POST['department_id'];
$secretary->username = $_POST['username'];
$secretary->password = $_POST['password'];
$secretary->update();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
http_response_code(200);
?>