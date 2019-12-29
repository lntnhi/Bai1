<?php include_once("header.php") ?>
<?php include_once("nav.php") ?>

<?php
include_once("model/categoryModel.php");
include_once("model/productModel.php");

$lsCategory = Category::getList();
if (isset($_REQUEST["add"])) {
    $name = $_REQUEST["name"];
    $description = $_REQUEST["description"];
    $price = $_REQUEST["price"];
    $img = "";
    if(isset($_FILES["image"])){
		if($_FILES["image"]["name"] != "") {
            $image_name = "img_" . time();
            move_uploaded_file($_FILES["image"]["tmp_name"], "img/" . $image_name . ".png"); // lưu ảnh vào thư mục
            $img = "img/" . $image_name . ".png"; // Url ảnh để lưu vào DB. 
		}
	}
    $categoryID = $_REQUEST["categoryID"];
    Product::add ($name, $description, $price, $img, $categoryID);
}

if (isset($_REQUEST["edit"])) {	
    $ID = $_REQUEST["edit"];
    $name = $_REQUEST["name"];
    $description = $_REQUEST["description"];
    $price = $_REQUEST["price"];
    $img = "";
    if(isset($_FILES["image"])){
		if($_FILES["image"]["name"] != "") {
            $image_name = "img_" . time();
            move_uploaded_file($_FILES["image"]["tmp_name"], "img/" . $image_name . ".png"); // lưu ảnh vào thư mục
            $img = "img/" . $image_name . ".png"; // Url ảnh để lưu vào DB. 
		}
	}
    $categoryID = $_REQUEST["categoryID"];
    Product::edit($ID, $name, $description, $price, $img, $categoryID);
}

if (isset($_REQUEST["del"])) {
    $ID = $_REQUEST["del"];
    Product::delete($ID);
}

if (isset($_REQUEST["categoryid"])) {
    $categoryid = $_REQUEST["categoryid"];
    $ls = Product::getList($categoryid);
} else {
    $keyWord = null;
    if (strpos($_SERVER['REQUEST_URI'], "search")) {
        $keyWord = $_REQUEST['search'];      
    }
    $ls = Product::getListAll($keyWord);
}

/**
 * HTML
 */
?>

<div class="container pt-5">
  <button class="btn btn-outline-info float-right" data-toggle="modal" data-target="#addItem"><i class="fas fa-plus-circle"></i> Thêm</button>
  <form action="" method="GET">
    <div class="form-group">
      <input class="form-control" name="search" value="<?php echo $_REQUEST["search"] ?? ""; ?>" style="max-width: 200px; display:inline-block;" placeholder="Search">
      <button type="submit" class="btn btn-default" style="margin-left:-50px"><i class="fas fa-search"></i></button>
    </div>
  </form>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Price</th>
        <th scope="col">Image</th>
        <th scope="col">Category</th>
        <th scope="col"> </th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach ($ls as $key => $value) {?>
        <tr>
          <th scope="row"><?php echo $value->ID ?></th>
          <td><a href="admin_news.php?categoryid='<?php echo $value->ID ?>'"><?php echo $value->name ?></a></td>
          <td><?php echo $value->description ?></td>
          <td><?php echo $value->price ?></td>
          <td><img src="<?php echo $value->image?>" width="100px"></td>
          <?php $category = Category::getCategoryByID($value->categoryID)?>
          <td><?php echo $category->name ?></td>
          <td class="d-flex">
            <button class="btn btn-outline-info mr-3" data-toggle="modal" data-target="#editItem<?php echo $key ?>"><i class="far fa-edit"></i> Sửa</button>
            <button class="btn btn-outline-danger" name="delete" data-toggle="modal" data-target="#deleteItem<?php echo $key ?>"><i class="fas fa-trash-alt"></i> Xóa</button>
            <!--Edit-->
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal fade" id="editItem<?php echo $key ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="from">Name</label>
                                        <input type="text" class="form-control" name="name" value="<?php echo $value->name ?>" placeholder="Name" required>
                                    </div>
                                    <div class="form-group ">
                                        <label for="from">Description</label>
                                        <textarea class="form-control ckeditor" rows="3" name="description" id="<?php echo $value->description ?>" required><?php echo $value->description ?></textarea>
                                    </div>
                                    <div class="form-group ">
                                        <label for="from">Price</label>
                                        <input type="text" class="form-control" name="price" value="<?php echo $value->price ?>" required>
                                    </div>
                                    <div class="form-group ">
                                        <label for="image">Image</label>
                                        <img src="<?php echo $value->image ?>" width = "200px">
                                        <input type="file" class="form-control-file" id="customFile" name="image">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select class="form-control" name="categoryID" id="category">
                                            <?php foreach ($lsCategory as $k => $val) {?>
                                            <option value="<?php echo $val->ID?>" <?php echo ($value->categoryID==$val->ID)? "selected" : ""?>><?php echo $val->name ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-primary" name="edit" type="submit" value="<?php echo $value->ID ?>">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </form> <!--end Edit-->
            <!--Delete-->
            <form action="" method="DELETE">
              <div class="modal fade" id="deleteItem<?php echo $key ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Notice</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">Do you want to delete this?</div>
                    <div class="modal-footer">
                      <button class="btn btn-danger" name="del" type="submit" value="<?php echo $value->ID ?>">Delete</button>
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
            </form> <!--end Delete-->
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

<!--Add-->
<div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="from">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Name" required>
          </div>
          <div class="form-group ">
            <label for="from">Description</label>
            <textarea class="form-control ckeditor" name="description" id="des" required></textarea>
          </div>
          <div class="form-group ">
            <label for="from">Price</label>
            <input type="text" class="form-control" name="price" required>
          </div>
          <div class="form-group ">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="customFile" name="image" required>
          </div>
          <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" name="categoryID" id="category">
                <?php foreach ($lsCategory as $key => $value) {?>
                <option value="<?php echo $value->ID?>"><?php echo $value->name ?></option>
                <?php }?>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="add">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> <!--End Add-->
<?php include_once("footer.php") ?>
<script src="js/ckeditor.js"></script>