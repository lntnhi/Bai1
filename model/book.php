<?php 
class Book {
    #properties
    var $id;
    var $title;
    var $price;
    var $author;
    var $year;
    #endProperties

    #Construct function
    function __construct ($id, $title, $price, $author, $year) {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->author = $author;
        $this->year = $year;
    }

    #Member function
    function display() {
        echo "Price: " . $this->price . "<br>";
        echo "Title: " . $this->title . "<br>";
        echo "Author: " . $this->author . "<br>";
        echo "Year: " . $this->year . "<br>";
    }

    #Mock Data
    /**
     * Lấy toàn bộ các cuốn sách có trong CSDL
     */
    static function getList() {
        $listBook = array();
        array_push($listBook, new Book(1,5, "Hihi", "Nhi1", 2019)); //Thêm 1 phần tử vào mảng
        array_push($listBook, new Book(2,6, "Huhu", "Nhi2", 2018));
        array_push($listBook, new Book(3,7, "Hehe", "Nhi3", 2017));
        array_push($listBook, new Book(4,8, "Hoho", "Nhi4", 2016));
        array_push($listBook, new Book(5,9, "Haha", "Nhi5", 2015));
        return $listBook;
    }

    /**
     * Lấy dữ liệu từ file / Tìm kiếm
     */
    static function getListFromFile($search = null) {
        $data = file("data/book.txt");
        $arrBook = [];
        foreach($data as $key => $value){
            $row = explode("#",$value); //tách chuỗi ngăn bởi #
            if(
                strlen(strstr($row[0],$search)) || strlen(strstr($row[3],$search)) ||
                strlen(strstr($row[1],$search)) || strlen(strstr($row[4],$search)) ||
                strlen(strstr($row[2],$search)) || $search == null
            )
            $arrBook[] = new Book($row[0],$row[1],$row[2],$row[3],$row[4]);
        }
        return $arrBook;
    }

    /**
     * Lấy dữ lịu từ db
     */
    static function connect () {
        $con = new mysqli("localhost","root","","BookManager");
        $con->set_charset("utf8");
        if ($con->connect_error)
            die("Kết nối thất bại. Chi tiết: " . $con->connect_error);
        return $con;
    }
    static function getListFromDB() {
        $con = Book::connect();
        $sql = "SELECT * FROM Book";
        $res = $con->query($sql);
        $lsBook = [];
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $book = new Book($row["ID"],$row["Title"],$row["Price"],$row["Author"],$row["Year"]);
                array_push($lsBook,$book);
            }
        }
        $con->close();
        return $lsBook;
    }

    /**
     * Add
     */
    static function addToFile($content) {
        $myfile = fopen("data/book.txt", "a") or die("Unable to open file!");
        fwrite($myfile, "\n". $content);
        fclose($myfile);
    }
    static function addToDB ($title, $price, $author, $year) {
          $con = Book::connect();
          $sql = "INSERT INTO Book(Title,Price,Author,Year) VALUES ('$title', $price, '$author', $year)";
          $res = $con->query($sql);
          $con->close();
    }
    
    /**
     * Chỉnh sửa
     */
    static function edit(Book $content){
        $data = Book::getListFromFile();
        $text_write = "";
        $myfile = fopen("data/book.txt", "w") or die("Unable to open file!");
        foreach($data as $key => $value){          
            if( $content->id == $value->id){
                $text_write.= $content->id."#".$content->price."#".$content->title."#".$content->author."#".$content->year;             
            }  
            else $text_write.= $value->id."#".$value->price."#".$value->title."#".$value->author."#".$value->year;
        }       
        fwrite($myfile, $text_write);
        fclose($myfile);
    }
    static function editDB ($id, $title, $price, $author, $year) {
         $con = Book::connect();
         $sql = "UPDATE Book SET Title = '$title', Price = $price, Author = '$author', Year = $year WHERE Book.ID=$id";
         $res = $con->query($sql);
         $con->close();
    }

    /**
     * Xóa
     */
    static function delete($id){
        $data = Book::getListFromFile();
        $data_res = [];
        foreach($data as $key => $value){
            if($value->id != $id){
                $data_res[] = $value;
            }
        }
        $text_write = "";
        $myfile = fopen("data/book.txt", "w") or die("Unable to open file!");
        foreach($data_res as $key => $value){
            $text_write.= $value->id."#".$value->price."#".$value->title."#".$value->author."#".$value->year;
        }
        fwrite($myfile, $text_write);
        fclose($myfile);
    }
    static function deleteDB($id) {
        $con = Book::connect();
         $sql = "DELETE FROM Book WHERE Book.ID=$id";
         $res = $con->query($sql);
         $con->close();
    }
    /**
     * Tự tăng STT
     */
    static function getSTT(){
        $max = 0;
        $data = Book::getListFromFile();
        foreach($data as $key => $value){
            $max =  max($value->id,$max);
        }  
        return $max+1;
    }

    /**
     * Phân trang
     */
    static function getBookOfPage($page){
        $tempArr = array();
        $listBook = Book::getListFromDB();
        $startItem = ($page-1)*5;
        $endItem = $startItem + 4;
        for ($i = $startItem; $i <= $endItem; $i++) {
            if(isset($listBook[$i])){
                array_push($tempArr, $listBook[$i]);
            }  
        }
        return $tempArr;
    }
}
?>