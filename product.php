<?php
require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($className) {
    require './app/models/' . $className . '.php';
});

$id = $_GET['id'];

$productModel = new ProductModel();
$item = $productModel->getProductById($id);

$categoryModel = new CategoryModel();
$categoryList = $categoryModel->getCategoryList();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="/<?php echo BASE_URL; ?>/public/css/bootstrap.min.css"> -->
</head>
<body>
    
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a class="navbar-brand" href="#">Shop</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="/<?php echo BASE_URL; ?>/">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="get" action="/<?php echo BASE_URL ?>/result.php">
                <input class="form-control ms-auto" type="text" placeholder="Search" name="keyword">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <!-- Hiển thị chi tiết sản phẩm-->
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <img src="public/images/<?php echo $item['product_image'] ?>" alt="" class="img-fluid">
            </div>
            <div class="col-md-10">
                <h4><?php echo $item['product_name']; ?></h4>
                <p><?php echo $item['product_price']; ?></p>
                <p><?php echo $item['product_description']; ?></p>
            </div>
        </div>
    </div>

    <!-- Hiển thị comment sản phẩm -->
    <div class="container">
        <area shape="" coords="" href="" alt="">
    </div>
</body>
</html>