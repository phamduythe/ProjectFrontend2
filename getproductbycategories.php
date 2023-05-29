<?php
$input = json_decode(file_get_contents('php://input'), true);
$id = $input['categoryId'];

require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($className) {
    require './app/models/' . $className . '.php';
});

$productModel = new ProductModel();
if (count($id) <= 0) {
    $item= $productModel->getProducts();
}
else {
    $item = $productModel->getProductByCategories($id);
}

echo json_encode($item);