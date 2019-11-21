<?php
session_start();
include_once("model/categoryModel.php");
include_once("model/productModel.php");
include_once("model/cart.php");

if (!isset($_SESSION["lsCart"])) {    
  $lsCart = [];
}
else {
  $lsCart = unserialize($_SESSION["lsCart"]);
}
if ($_SERVER["REQUEST_METHOD"]=="POST") {
  $ID = $_REQUEST["ID"];
  $quantity = $_REQUEST["quantity"];
  if (Cart::existProduct($ID, $lsCart)) {
    $lsCart = Cart::addQuantity($ID, $quantity, $lsCart);
  } else {
    $cart = new stdClass;
    $cart->ID = $ID;
    $cart->quantity = $quantity;
    array_push($lsCart,$cart);
  }
  $_SESSION["lsCart"] = serialize($lsCart); 
  header("location:ShoppingCart.php");
}

/**
 * Hiển thị
 */
$lsCategory = Category::getList();
if (strpos($_SERVER['REQUEST_URI'], "ID")) {
  $ID = $_REQUEST["ID"];   
  $product = Product::getProductByID($ID);
  $category = Category::getCategoryByID($product->categoryID);
}     
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="pragma" content="no-cache" />
  <meta http-equiv="cache-control" content="max-age=604800" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Product Detaill</title>

  <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">

  <!-- jQuery -->
  <script src="js/jquery-2.0.0.min.js" type="text/javascript"></script>

  <!-- Bootstrap4 files-->
  <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>

  <!-- Font awesome 5 -->
  <link href="fonts/fontawesome/css/all.min.css" type="text/css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>

  <!-- custom style -->
  <link href="css/ui.css" rel="stylesheet" type="text/css"/>
  <link href="css/show.css" rel="stylesheet" type="text/css"/>
  <link href="css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />
</head>

<body>
<header class="section-header">
<section class="header-main border-bottom">
	<div class="container">
<div class="row align-items-center">
    <div class="col-lg-2 col-4">
		<a href="ShowProduct.php" class="brand-wrap">
			<img class="logo" src="img/logo.jpg">
		</a> 
	</div>
    <!--=========================== SEARCH =========================-->
	<div class="col-lg-9 col-12 col-sm-12">
        <form action="ShowProduct.php" class="form-inline container-fluid text-center">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input name="search" value="<?php echo $_REQUEST["search"] ?? ""; ?>" class="form-control ml-3 w-75 border-0" type="text" placeholder='Tìm kiếm' aria-label="Search" style="background:#f5f6f7">
        </form>
	</div> 
    <div class="col-lg-1 col-sm-6 col-12">
		<div class="widgets-wrap float-md-right">
			<div class="widget-header  mr-3">
				<a href="ShoppingCart.php" class="icon icon-sm rounded-circle border"><i class="fa fa-shopping-cart"></i></a>
				<span class="badge badge-pill badge-danger notify"><?php echo count($lsCart)?></span>
			</div>
		</div> 
	</div> 
</div> 
	</div> 
</section> 
</header> 
<nav class="navbar navbar-main navbar-expand-lg navbar-light border-bottom">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
<!-- ========================= CATEGORY ========================= -->
    <div class="collapse navbar-collapse" id="main_nav">
    <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="ShowProduct.php"><strong>Tất cả sản phẩm</strong></a>
        </li>
        <?php foreach ($lsCategory as $key => $value) {?>
            <li class="nav-item">
                <a class="nav-link" href="ShowProduct.php?category=<?php echo $value->ID?>"><?php echo $value->name ?></a>
            </li>
        <?php } ?>
      </ul>
    </div> 
  </div> 
</nav>
</header> 

<!-- ========================= PRODUCT ========================= -->
<section class="section-content mb-5">
    <div class="container pt-5">            
        <div class="row">
            <main class="col-md-8 offset-md-2">
                <header class="section-heading">
                    <h3 class="section-title "><i class="fa fa-info-circle"></i>Thông tin sản phẩm</h3>
                </header>
                <div class="row product-main">
                    <div class="col-md-6 product-image mt-3">
                        <div class="main-image">
                            <img src=<?php echo $product->image?> alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6 product-info mt-3 pl-4">
                        <h5 class="card-title product-name text-danger"><?php echo $product->name?></h5>
                        <p class="text-muted">
                            <small>Phân loại: </small>
                            <small><?php echo $category->name?></small>
                        </p>
                        <div class="product-price my-3">
                            <span class="sell-price"><?php echo number_format($product->price, 0, '.', ',') ?>đ</span>
                            <!--format: lấy 0 chữ số thập phân, cứ 3 số ngăn cách nhau bởi dấu phẩy, phần nguyên và phần thập phân ngăn cách nhau bởi dấu chấm -->
                        </div>
                        <div class="product-description my-3"><?php echo $product->description?></div>
                        <div class="product-quantity my-3">
                            <!--================== GIỎ HÀNG =======================-->
                            <form method="POST" class="d-flex align-items-center">
                                <div class="change-quantity flex-fill mt-2">
                                    <span>Số lượng: </span>
                                    <!-- Chèn id của product vào phần value của thẻ sau -->
                                    <input type="hidden" name="ID" value="<?php echo $product->ID?>">
                                    <input name="quantity" type="number" class="current-quantity form-control" min="1" max="100" value="1">
                                </div>
                                <div class="product-action flex-fill mt-2">
                                    <button type="submit" class="btn btn-sm btn-info btn-add-to-cart"><i class="fa fa-shopping-cart"></i> <span>Thêm vào giỏ</span></button>
                                </div>
                            </form>
                        </div>                        
                    </div>
                </div>
            </main> 
        </div> 

    </div> 
</section>
</body>
</html>