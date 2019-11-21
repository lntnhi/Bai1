<?php 
class Contact {
    #properties
    var $ID;
    var $name;
    var $email;
    var $phoneNumber;
    #endProperties

    #Construct function
    function __construct ($ID, $name, $email, $phoneNumber) {
        $this->ID = $ID;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    static function connect () {
        $con = new mysqli("localhost","root","","Contact");
        $con->set_charset("utf8");
        if ($con->connect_error)
            die("Kết nối thất bại. Chi tiết: " . $con->connect_error);
        return $con;
    }

    static function getListAll($username, $keyword=null) {
        $con = Contact::connect();
        $sql = "SELECT * FROM Contact 
                WHERE Username = '$username' AND (Name LIKE '%$keyword%' OR Email LIKE '%$keyword%' OR PhoneNumber LIKE '%$keyword%')
                ORDER BY Name";
        $res = $con->query($sql);
        $ls = [];
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $tag = new Contact($row["ID"],$row["Name"],$row["Email"],$row["PhoneNumber"]);
                array_push($ls,$tag);
            }
        }
        $con->close();
        return $ls;
    }

    static function getList($tagID=null) {
        $con = Contact::connect();
        $sql = "SELECT * FROM Contact INNER JOIN contact_tag ON contact_tag.ContactID = contact.ID WHERE TagID = '$tagID'";
        $res = $con->query($sql);
        $ls = [];
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $tag = new Contact($row["ID"],$row["Name"],$row["Email"],$row["PhoneNumber"]);
                array_push($ls,$tag);
            }
        }
        $con->close();
        return $ls;
    }

    /**
     * Add
     */
    static function addContact ($name, $email, $phoneNumber, $username) {
        $con = Contact::connect();
        $sql = "INSERT INTO Contact(Name, Email, PhoneNumber, Username) VALUES ('$name','$email','$phoneNumber','$username')";
        $res = $con->query($sql);
        $con->close();
    }
}
?>