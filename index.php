<?php
session_start(); //nhớ cả quên lè, đặt chên cùng lun
include_once("model/user.php");
if (!isset($_SESSION["user"])) {
    header("location:login.php"); //chưa đăng nhập thì hông cho zô index
}
?>

<?php include_once("header.php")?>
<?php include_once("nav.php")?>

<?php
$user = unserialize($_SESSION["user"]); //hàm ngược của hàm serialize bên login.php, biến chuỗi thành User
echo "Chào " . $user->fullname;
?>

<?php include_once("footer.php")?>