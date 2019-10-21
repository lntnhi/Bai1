<?php
class User {
    var $username;
    var $password;
    var $fullname;

    function User($username, $password, $fullname) {
        $this->username = $username;
        $this->password = $password;
        $this->fullname = $fullname;
    }

    /**
     * Xác thực user
     * @param $username string Tên đăng nhập
     * @param $username string Mật khẩu
     * @return User hoặc null nếu không tồn tại
     */
    static function authentication ($username, $password) {
        if ($username == "admin" && $password=="123")
            return new User($username, $password, "Nhi");
        else return null;
    }
}
?>