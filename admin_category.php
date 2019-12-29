<?php include_once("header.php") ?>
<?php include_once("nav.php") ?>

<?php
include_once("model/categoryModel.php");

if (isset($_REQUEST["add"])) {
    $name = $_REQUEST["name"];
    Category::add($name);
}

if (isset($_REQUEST["edit"])) {	
    $ID = $_REQUEST["edit"];
    $name = $_REQUEST["name"];
    Category::edit($ID, $name);
}

if (isset($_REQUEST["del"])) {
    $ID = $_REQUEST["del"];
    Category::delete($ID);
}

$keyWord = null;
if (strpos($_SERVER['REQUEST_URI'], "search")) {
    $keyWord = $_REQUEST['search'];      
}
$lsCategory = Category::getList($keyWord);
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
        <th scope="col"> </th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach ($lsCategory as $key => $value) {?>
        <tr>
          <th scope="row"><?php echo $value->ID ?></th>
          <td><a href="admin_product.php?categoryid='<?php echo $value->ID ?>'"><?php echo $value->name ?></a></td>
          <td class="d-flex">
            <button class="btn btn-outline-info mr-3" data-toggle="modal" data-target="#editItem<?php echo $key ?>"><i class="far fa-edit"></i> Sửa</button>
            <button class="btn btn-outline-danger" name="delete" data-toggle="modal" data-target="#deleteItem<?php echo $key ?>"><i class="fas fa-trash-alt"></i> Xóa</button>
            <!--Edit-->
            <form action="" method="GET">
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
                                    <div class="form-group ">
                                        <label for="from">Tên</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $value->name ?>" placeholder="Tên">
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
        <form method="get">
          <div class="form-group ">
            <label for="from">Tên</label>
            <input type="text" class="form-control" name="name" placeholder="Tên">
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