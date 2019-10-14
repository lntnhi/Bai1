
<?php include_once("header.php")?>
    <?php include_once("nav.php")?>
    <?php
    echo "<h1>ĐÓI QUÁAAAAAAAAAAAAAAAAA</h1>";

    define('PI','3.14');

    /**
     * Tính diện tích hình tròn
     * @param $r bán kính
     * @return diện tích hình tròn có bán kính $r
     */
    function dienTichHinhTron ($r) {
        $s = M_PI * pow($r,2);
        return $s;
    }    

    function sum ($n) {
        $s = 0;
        for ($i=0; $i < $n; $i++) { 
            $s += $i;
        }
        return $s;
    }

    function displayToday () {
        $dayOfWeek = [
            "Sunday",
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday"
        ];
        $day = date("w"); //w là ngày trong tuần
        //var_dump($day); //hiển thị thông tin của biến
        return $dayOfWeek[$day];
    }

    $r = 5;
    $s = dienTichHinhTron($r);
    echo "Diện tích hình tròn bán kính $r là $s";

    $tong = sum($r);
    echo "<h4>Tổng của $r số đầu tiên là $tong</h4>";

    echo "Hôm nay là " . displayToday();
    ?>
    
    <?php include_once("footer.php")?>
