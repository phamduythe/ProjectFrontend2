<?php
$input = json_decode(file_get_contents('php://input'), true);
$keyword = $input['keyword'];

require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($className) {
    require './app/models/' . $className . '.php';
});

$productModel = new ProductModel();
$item = $productModel->searchProduct($keyword);

echo json_encode($item);