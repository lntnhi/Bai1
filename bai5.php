<?php
session_start(); //nhớ cả quên lè, đặt chên cùng lun
include_once("model/user.php");
if (!isset($_SESSION["user"])) {
    header("location:login.php"); //chưa đăng nhập thì hông cho zô
}
?>

<?php include_once("header.php")?>
<?php include_once("nav.php")?>

<button onclick="testAjax();" type="button">Test JS</button>
<div id="contentAjax"></div>

<?php include_once("footer.php")?>
<script>
    function testAjax() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() { //khi cái kia thay đổi thì gọi hàm
            if (this.readyState == 4 && this.status == 200) { // = 4 là xử lý xong, 200 là OK hihihihihihi
                // var user = JSON.parse(this.responseText); //biến Json thành object lại
                // var str = "<ul>";
                
                // str+="<li>";
                // str+= "Username: " + user.username;
                // str+="</li>";

                // str+="<li>";
                // str+= "Password: " + user.password;
                // str+="</li>";

                // str+="<li>";
                // str+= "Full name: " + user.fullname;
                // str+="</li>";

                // str+="</ul>";

                document.getElementById("contentAjax").innerHTML = str;
            }
        }
        xhttp.open("GET","testajax.php?username=admin",true);
        xhttp.send();
    }
</script>