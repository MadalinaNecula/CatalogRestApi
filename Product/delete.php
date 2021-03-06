<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../Configuration/database.php';
include_once '../Models/Product.php';

$database = new Database();
$db=$database->getConnection();

$product = new Product($db);

//Get post data
$data = json_decode(file_get_contents("php://input"));

//set Id of product to be deleted
$product->id = $data->id;


//delete product
if($product->delete()){
    echo '{';
        echo '"message": "Product was deleted."';
    echo '}';
}else{
    echo '{';
        echo '"message": "Unable to delete product."';
    echo '}';
}