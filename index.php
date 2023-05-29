<?php
require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($className) {
    require './app/models/' . $className . '.php';
});

$productModel = new ProductModel();
$productList = $productModel->getProducts();

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
    <link rel="stylesheet" href="/<?php echo BASE_URL; ?>/public/css/styles.css">
    <style>
        .loader { display: none;
        position: absolute;
        }
        .loader img{
            position: relative;
            left:150%;
            top:200px;
        }
        a{
                 text-decoration: none;
        }
        body{
            background-attachment: fixed;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
                </li>
            </ul>
            <form class="d-flex position-relative" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="input-keyword">
                <button class="btn btn-outline-success" type="submit">Search</button>
                
                <div class="position-absolute top-100 start-0 end-0">
                    <div class="list-group search-item">
                    </div>
                </div>
            </form>
            </div>
        </div>
    </nav>
    <div class="loader"><img src="public/images/load.gif" alt=""></div>

    <div class="container">
        <div class="row">
            <!-- Categories -->
            <div class="col-md-2">
                <ul class="list-group">
                <?php
                foreach ($categoryList as $category) {
                ?>
                <li class="list-group-item">
                    <label>
                        <input type="checkbox" name="categoryId" id="" value="<?php echo  $category['category_id']; ?>">
                        <?php echo  $category['category_name']; ?>
                    </label>
                </li>
                <?php
                }
                ?>
                </ul>
            </div>
            <!-- Danh sach san pham -->
            <div class="col-md-6 product-list">
            </div>
            
            <!-- Chi tiet san pham -->
            <div class="col-md-4">
                <h3>Thông tin chi tiết</h3>
                <div class="product-detail"></div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/mark.min.js"
        integrity="sha512-5CYOlHXGh6QpOFA/TeTylKLWfB3ftPsde7AnmhuitiTX4K5SqCLBeKro6sPS8ilsz1Q4NRx3v8Ko2IBiszzdww=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="public/js/app.js"></script>
</body>
</html>