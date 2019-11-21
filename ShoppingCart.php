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
if (isset($_REQUEST["delete"])) {
	$ID = $_REQUEST["delete"];
	$lsCart = Cart::deleteProduct($ID, $lsCart);
	$_SESSION["lsCart"] = serialize($lsCart);
}
if (isset($_REQUEST["save"])) {
	$ID = $_REQUEST["save"];
	$quantity = $_REQUEST["quantity"];
	$lsCart = Cart::updateQuantity($ID, $quantity, $lsCart);
	$_SESSION["lsCart"] = serialize($lsCart);
} 
$lsCategory = Category::getList(); 
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="cache-control" content="max-age=604800" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Shopping Cart</title>

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
				<a href="#" class="icon icon-sm rounded-circle border"><i class="fa fa-shopping-cart"></i></a>
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
<section class="section-pagetop bg">
<div class="container">
	<h2 class="title-page">Shopping cart</h2>
</div>
</section>

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
<div class="container">

<div class="row">
	<main class="col-md-12">
<div class="card">
<table class="table table-borderless table-shopping-cart">
<thead class="text-muted">
<tr class="small text-uppercase">
  <th scope="col">Product</th>
  <th scope="col" width="120">Quantity</th>
  <th scope="col" width="120">Price</th>
  <th scope="col" class="text-right" width="200"> </th>
</tr>
</thead>
<tbody>
<!--========================CART========================-->
<?php foreach ($lsCart as $key => $value) {
		$product = Product::getProductByID($value->ID);
		$category = Category::getCategoryByID($product->categoryID);?>
<form method="POST" class="d-flex align-items-center">
<tr>
	<td>
		<figure class="itemside">
			<div class="aside"><img src="<?php echo $product->image?>" class="img-sm"></div>
			<figcaption class="info">
				<a href="ProductDetail.php?ID='<?php echo $product->ID?>'" class="title text-dark"><?php echo $product->name?></a>
				<p class="text-muted small">Loại: <?php echo $category->name?></p>
			</figcaption>
		</figure>
	</td>
	<td> 		
		<div class="change-quantity flex-fill mt-2">
			<!-- Form -->
			<input name="quantity" type="number" class="current-quantity form-control" min="1" max="100" value="<?php echo $value->quantity?>">
		</div>			
	</td>
	<td> 
		<div class="price-wrap"> 
			<var class="price"><?php echo number_format(Cart::priceOfOne($product->price, $value->quantity), 0, '.', ',') ?>đ</var> 
			<small class="text-muted"><?php echo number_format($product->price, 0, '.', ',') ?>đ each </small> 
		</div> 
	</td>
	<td class="text-right"> 
		<!-- Form -->
		<button name="save" value="<?php echo $product->ID?>" type="submit" class="btn btn-light"><i class="fa fa-save"></i> Lưu</button>
		<button name="delete" value="<?php echo $product->ID?>" type="submit" class="btn btn-light"><i class="fa fa-trash"></i> Xóa</button>
	</td>
</tr>
</form>    
<?php } ?>
<tr>
	<td class="text-right"><h5>Tổng tiền: </h5></td>
	<td></td>	
	<td><h5><?php echo number_format(Cart::totalPrice($lsCart), 0, '.', ',') ?>đ</h5></td>
</tr>
</tbody>
</table>
<div class="card-body border-top">
	<a href="#" class="btn btn-primary float-md-right"> Thanh toán <i class="fa fa-chevron-right"></i> </a>
	<a href="ShowProduct.php" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Tiếp tục shopping </a>
</div>	
</div> 
</main> 
</div>
</div> 
</section>
</body>
</html>