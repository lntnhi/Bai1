<?php 
class Product {
    #properties
    var $ID;
    var $name;
    var $description;
    var $price;
    var $image;
    var $categoryID;
    #endProperties

    #Construct function
    function __construct ($ID, $name, $description, $price, $image, $categoryID) {
        $this->ID = $ID;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
        $this->categoryID = $categoryID;
    }

    static function connect () {
        $con = new mysqli("localhost","root","","Shop");
        $con->set_charset("utf8");
        if ($con->connect_error)
            die("Kết nối thất bại. Chi tiết: " . $con->connect_error);
        return $con;
    }

    /**
     * Lấy dữ liệu
     */
    static function getListAll($keyword=null) {
        $con = Product::connect();
        $sql = "SELECT * FROM Product
                WHERE Name LIKE '%$keyword%' OR Price LIKE '%$keyword%'";
        $res = $con->query($sql);
        $ls = [];
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $product = new Product($row["ID"],$row["Name"],$row["Description"],$row["Price"],$row["Image"],$row["CategoryID"]);
                array_push($ls,$product);
            }
        }
        $con->close();
        return $ls;
    }
    static function getList($categoryID) {
        $con = Product::connect();
        $sql = "SELECT product.ID, product.Name, Description, Price, Image, CategoryID 
                FROM product INNER JOIN category ON category.ID = product.CategoryID 
                WHERE CategoryID = $categoryID";
        $res = $con->query($sql);
        $ls = [];
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $product = new Product($row["ID"],$row["Name"],$row["Description"],$row["Price"],$row["Image"],$row["CategoryID"]);
                array_push($ls,$product);
            }
        }
        $con->close();
        return $ls;
    }
    static function getProductByID($ID) {
        $con = Product::connect();
        $sql = "SELECT * FROM product WHERE ID = $ID";
        $res = $con->query($sql);
        $ls = [];
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $product = new Product($row["ID"],$row["Name"],$row["Description"],$row["Price"],$row["Image"],$row["CategoryID"]);
            }
        }
        $con->close();
        return $product;
    }
}
?>