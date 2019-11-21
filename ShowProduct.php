<?php
session_start();
include_once("model/categoryModel.php");
include_once("model/productModel.php");

if (!isset($_SESSION["lsCart"])) {    
  $lsCart = [];
}
else {
  $lsCart = unserialize($_SESSION["lsCart"]);
}
/**
 * Hiển thị
 */
$lsCategory = Category::getList();
if (isset($_REQUEST["category"])) {
    $category = $_REQUEST["category"]; 
    $lsProduct = Product::getList($category);
} else {
    $keyWord = null;
    if (strpos($_SERVER['REQUEST_URI'], "search")) {
      $keyWord = $_REQUEST['search'];      
    }
    $lsProduct = Product::getListAll($keyWord);
} 
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="max-age=604800" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Show Products</title>

    <!-- Bootstrap4 files-->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!-- Font awesome 5 -->
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
    <!--=============================== SEARCH ============================-->
	<div class="col-lg-9 col-12 col-sm-12">
        <form class="form-inline container-fluid text-center">
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

    <!--=============================== SHOW CATEGORY ===========================-->
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

<section class="section-intro padding-y-sm">
    <div class="container">

    <div class="intro-banner-wrap">
        <img src="img/banner.jpg" class="img-fluid rounded">
    </div>

    </div> <!-- container //  -->
</section>


<!-- ========================= PRODUCT ========================= -->
<section class="section-content">
<div class="container">

<header class="section-heading">
	<h3 class="section-title">Products</h3>
</header>

<div class="row">
    <?php foreach ($lsProduct as $key => $value) {?>
    <div class="col-md-3">
      <div class="card card-product-grid">
        <a href="ProductDetail.php?ID='<?php echo $value->ID?>'" class="img-wrap"> <img src="<?php echo $value->image ?>"> </a>
        <figcaption class="info-wrap">            
                  <a href="ProductDetail.php?ID='<?php echo $value->ID?>'" class="title"><?php echo $value->name ?></a>
          <div class="price mt-1"><?php echo number_format($value->price, 0, '.', ',') ?>đ</div> 
        </figcaption>
      </div>
    </div> 
    <?php } ?>
</div>
</div>
</section>
</body>
</html>