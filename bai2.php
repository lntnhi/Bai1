    <?php include_once("header.php")?>
    <?php include_once("nav.php")?>
    <form>
        <fieldset>
            <legend>Tính toán cơ bản</legend>
            <input type="text" name="num1" value="<?php echo $_GET["num1"] ?? ""; ?>" placeholder="Số thứ nhất"> <!--?? nghĩa là nếu = null thì lấy chuỗi ở phía sau-->
            <input type="text" name="num2" value="<?php echo $_GET["num2"] ?? ""; ?>" placeholder="Số thứ hai">
            <select name="operator">
                <option value="none">Vui lòng chọn phép tính</option>
                <option <?php echo $_GET["operator"] == "add"? "selected":""; ?> value="add">Cộng</option>
                <option <?php echo $_GET["operator"] == "subtract"? "selected":""; ?> value="subtract">Trừ</option>
                <option <?php echo $_GET["operator"] == "multiply"? "selected":""; ?> value="multiply">Nhân</option>
                <option <?php echo $_GET["operator"] == "divide"? "selected":""; ?> value="divide">Chia</option>
            </select>
            <button name="btnCalculate" type="submit" value="1">Tính</button>

            <?php
                //var_dump($_GET); //_GET là mảng chứa toàn bộ thông tin mình mới đưa lên
                if (isset($_GET["btnCalculate"])) {
                    $num1 = $_GET["num1"];
                    $num2 = $_GET["num2"];
                    $operator = $_GET["operator"];
                    $sign = "";
                    $result = "";
                    switch ($operator) {
                        case 'add':
                            $result = $num1 + $num2;
                            $sign = "+";
                            break;
                        case 'subtract':
                            $result = $num1 - $num2;
                            $sign = "-";
                            break;
                        case 'multiply':
                            $result = $num1 * $num2;
                            $sign = "*";
                            break;
                        case 'divide':
                            $result = $num1 / $num2;
                            $sign = "/";
                            break;
                        default:
                            $result = "Vui lòng chọn phép tính trước";
                            break;
                    }
                    echo "Kết quả $num1 $sign $num2 = $result";
                }
            ?>
        </fieldset>
    </form>
    <?php include_once("footer.php")?>
