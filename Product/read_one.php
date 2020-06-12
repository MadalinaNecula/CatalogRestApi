<?php

//Req headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: access");


include_once '../Configuration/database.php';
include_once '../Models/Product.php';


$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

//Set ID of product to be edited
$product->id = isset($_GET['id']) ? $_GET['id']: die;

//Read details of edited product
$product->readOne();

//Create array
$product_arr = array(
    "id" => $product->id,
    "name" => $product->name,
    "description" => $product->description,
    "price" => $product->price,
    "created_date" => $product->created_date,
    "category_name" => $product->category_name
);

print_r(json_encode($product_arr));