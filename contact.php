<?php
session_start(); //nhớ cả quên lè, đặt chên cùng lun
include_once("model/user.php");
include_once("model/contactModel.php");
include_once("model/tagModel.php");
if (!isset($_SESSION["user"])) {
    header("location:login.php"); //chưa đăng nhập thì hông cho zô
}
include_once("header.php");

$user = unserialize($_SESSION["user"]); //hàm ngược của hàm serialize bên login.php, biến chuỗi thành User
$lsTag = Tag::getList($user->username);

if (isset($_REQUEST["tag"])) {
    $tag = $_REQUEST["tag"]; 
    $lsFromDB = Contact::getList($tag);
} else { 
    $keyWord = null;
    if (strpos($_SERVER['REQUEST_URI'], "search")) { // hàm ktra chuỗi trước có chứa chuỗi sau không
      $keyWord = $_REQUEST['search'];      
    }
    $lsFromDB = Contact::getListAll($user->username, $keyWord);
} 
?>

<style> 
    .input-group.md-form.form-sm.form-1 input{
        border: 1px solid #bdbdbd;
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }
    .btn-light{
       border-radius: 1.5rem;
    }
</style>

<div class="container mt-2">
  <div class="row">
    <div class="col-sm-3">
        <nav class="navbar navbar-light teal lighten-4">
            <a class="navbar-brand" href="google.com"><img src="https://www.gstatic.com/images/branding/product/1x/contacts_48dp.png" class="pr-2">Danh bạ</a>
            <button class="navbar-toggler border-0" type="button"><span class="dark-blue-text"><i class="fas fa-bars fa-1x float-left"></i></span></button>
            <div>
                <button type="button" class="btn mt-3" style="box-shadow: 3px 3px 5px 0px #d9d8d7; border-radius:30px"><img src="https://img.icons8.com/windows/32/000000/plus-math.png" style="width:40px" class="ml-1 mr-2">Tạo liên hệ</button>
                <ul class="navbar-nav mr-auto mt-3">
                    <li class="nav-item" style="background:#d3e4f5; border-radius: 0 20px 20px 0">
                        <a class="nav-link" href="contact.php" style="color:#12a2db"><i class="fa fa-user ml-3 mr-3"></i> Danh bạ <span class="ml-5"><?php echo count(Contact::getListAll($user->username))?></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-clock ml-3 mr-3"></i> Thường xuyên liên hệ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-sticky-note ml-3 mr-3"></i> Liên hệ trùng lặp</a>
                    </li>
                    <li class="nav-item">
                        <hr>
                    </li>
                    <!--Nhãn-->
                    <li class="nav-item">    
                        <button class="navbar-toggler border-0" type="button"><span class="dark-blue-text"><i class="fas fa-chevron-up ml-1 mr-3"></i></span>    Nhãn</button>         
                        <div>
                        <ul class="navbar-nav mr-auto mt-3">
                            <?php
                                foreach ($lsTag as $key => $value) {?>
                                <li class="nav-item">
                                    <a class="nav-link" href="?tag=<?php echo $value->ID?>"><i class="fas fa-tag ml-3 mr-3"></i> 
                                        <span><?php echo $value->name ?></span> <span class="float-right mr-4"><?php echo $value->quantity ?></span></a>
                                </li>
                            <?php } ?>
                            <li class="nav-item">             
                            <a class="nav-link" href="#"><i class="fas fa-plus-circle ml-3 mr-3"></i> Tạo nhãn</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="col-sm-9 mt-3">
      <div class="row">
        <div class="col-sm-12">
            <div class="input-group md-form form-sm form-1 pl-0">
                <form class="form-inline container-fluid text-center">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input name="search" value="<?php echo $_REQUEST["search"] ?? ""; ?>" class="form-control ml-3 w-75 border-0" type="text" placeholder='Tìm kiếm' aria-label="Search" style="background:#f5f6f7">
                </form>
            </div>
        </div>
        <div class="col-sm-10">
            <table class="table table-borderless">
                <thead>
                    <tr>
                    <th scope="col">Tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr> 
                        <td>NGƯỜI LIÊN HỆ CÓ GẮN DẤU SAO </td>               
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="ml-3 mr-5"> Sâu</td>
                        <td>monmon@gmail.com</td>
                        <td>0123456789</td>
                    </tr>
                    <tr> 
                        <td>DANH BẠ</td> 
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                        foreach ($lsFromDB as $key => $value) {?>
                        <tr>
                        <td><input type="checkbox" class="ml-3 mr-5"> <?php echo $value->name ?></td>
                        <td><?php echo ($value->email!=null)?$value->email:"" ?></td>
                        <td><?php echo $value->phoneNumber ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once("footer.php") ?>