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
    $lsFromDB = Contact::getListAll()();
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

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3">
        <nav class="navbar navbar-light teal lighten-4">
            <a class="navbar-brand" href="#"><img src="https://www.gstatic.com/images/branding/product/1x/contacts_48dp.png" class="pr-2">Danh bạ</a>
            <button class="navbar-toggler" type="button"><span class="dark-blue-text"><i class="fas fa-bars fa-1x"></i></span></button>
            <div>
                <button type="button" class="btn btn-light mt-3"><img src="https://img.icons8.com/cotton/2x/add.png" style="width : 48px">Tạo liên hệ</button>
                <ul class="navbar-nav mr-auto mt-3">
                    <li class="nav-item" style="background:#d3e4f5; border-radius: 0 20px 20px 0">
                        <a class="nav-link" href="#" style="color:#12a2db"><i class="fa fa-user ml-3 mr-3"></i> Danh bạ <span class="sr-only">(current)</span></a>
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
                        <button class="navbar-toggler toggler-example border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation"><span class="dark-blue-text"><i class="fas fa-chevron-up" ></i></span> Nhãn</button>         
                        <div class="collapse navbar-collapse" id="navbarSupportedContent2">
                        <ul class="navbar-nav mr-auto mt-3">
                            <?php
                                foreach ($lsTag as $key => $value) {?>
                                <li class="nav-item">
                                    <a class="nav-link" href="?tag=<?php echo $value->ID?>"><i class="fas fa-tag ml-3 mr-3"></i> 
                                        <?php echo $value->name ?> (<?php echo $value->quantity ?>)</a>
                                </li>
                            <?php } ?>
                            <li class="nav-item">             
                            <a class="nav-link" href="#"><i class="fas fa-plus-circle ml-3 mr-3"></i> Tạo nhãn</a>
                            </li>
                        </ul>
                    </li>

                </ul>
                <!-- Links -->
            </div>
        </nav>
    </div>
    <div class="col-sm-9 mt-3">
      <div class="row">
        <div class="col-sm-12">
            <div class = "seach-contact">
                <div class="input-group md-form form-sm form-1 pl-0">
                    <form class="form-inline container-fluid text-center">
                        <i class="fas fa-search" aria-hidden="true"></i>
                        <input class="form-control ml-3 w-75" type="text" placeholder="Tìm kiếm" aria-label="Search" style="background:#f5f6f7">
                    </form>
                </div>
             </div>
        </div>
        <div class="col-sm-12">
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
                        <td><input type="checkbox"> Sâu</td>
                        <td>Mark</td>
                        <td>069696969</td>
                    </tr>
                    <tr> 
                        <td>DANH BẠ</td> 
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                        foreach ($lsFromDB as $key => $value) {?>
                        <tr>
                        <td><input type="checkbox"> <?php echo $value->name ?></td>
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