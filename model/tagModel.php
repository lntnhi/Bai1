<?php 
class Tag {
    #properties
    var $ID;
    var $name;
    var $quantity;
    #endProperties

    #Construct function
    function __construct ($ID, $name, $quantity) {
        $this->ID = $ID;
        $this->name = $name;
        $this->quantity = $quantity;
    }

    static function connect () {
        $con = new mysqli("localhost","root","","Contact");
        $con->set_charset("utf8");
        if ($con->connect_error)
            die("Kết nối thất bại. Chi tiết: " . $con->connect_error);
        return $con;
    }

    static function getList($username) {
        $con = Tag::connect();
        $sql = "SELECT tag.ID, tag.Name, COUNT(ContactID) AS Quantity 
                FROM Tag INNER JOIN contact_tag ON contact_tag.TagID = tag.ID 
                WHERE tag.Username = '$username'
                GROUP BY TagID";
        $res = $con->query($sql);
        $ls = [];
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $tag = new Tag($row["ID"],$row["Name"],$row["Quantity"]);
                array_push($ls,$tag);
            }
        }
        $con->close();
        return $ls;
    }
}
?>