    <?php include_once("header.php")?>
    <?php include_once("nav.php")?>

    <?php 
        $maSV = $ho = $ten = $ngaySinh = $email ="";
        //var_dump($_SERVER);
        if ($_SERVER["REQUEST_METHOD"] == "POST") { //post là bấm nút submit rồi, get là chưa
            $maSV = $_REQUEST["txtMSV"];
            $ho = $_REQUEST["txtHo"];
            $ten = $_REQUEST["txtTen"];
            $ngaySinh = $_REQUEST["datNgaySinh"];
            $email = $_REQUEST["txtEmail"];
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) { //ktra xem biến email đưa lên có đúng định dạng chưa
                echo "Đúng dồi";
            } else echo "Sai dồi";
            //var_dump($_FILES);
            if ($_FILES["fileAvt"]["tmp_name"]!= "")
                move_uploaded_file($_FILES["fileAvt"]["tmp_name"],"uploads/avt.jpg");
        }
    ?>
    <form method="post" enctype="multipart/form-data"> <!--https://www.w3schools.com/tags/att_form_enctype.asp-->  <!--Mã hóa cái đường dẫn link-->
    <div>
        <div>
            <label>Mã sinh viên</label>
        </div>
        <div>
            <input required type="text" name="txtMSV" value="<?php echo $maSV; ?>">
        </div>
        <div>
            <label>Họ</label>
        </div>
        <div>
            <input required type="text" name="txtHo" value="<?php echo $ho; ?>">
        </div>
        <div>
            <label>Tên</label>
        </div>
        <div>
            <input required type="text" name="txtTen" value="<?php echo $ten; ?>">
        </div>
        <div>
            <label>Ngày sinh</label>
        </div>
        <div>
            <input type="date" name="datNgaySinh" value="<?php echo $ngaySinh; ?>">
        </div>
        <div>
            <label>Email</label>
        </div>
        <div>
            <input required type="email" name="txtEmail" value="<?php echo $email; ?>">
        </div>
        <div>
            <label>Ảnh đại diện</label>
        </div>
        <div>
            <input type="file" name="fileAvt" value="">
        </div>
        <div>
            <input type="submit" name="btnSave" value="Lưu">
        </div>
    </div>
    </form>

    <?php include_once("footer.php")?>