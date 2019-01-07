<?php
include_once '../../library/config/dbhandler.php';
include_once '../../model/booksShops.php';

$dbhandler = new DBHandler();
$connection = $dbhandler->getConnection();

$bookShop = new BooksShops($connection);
$bookShop->id = $_GET['id'];
$response = $bookShop->getById();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
http_response_code(200);

echo json_encode($response);
?>