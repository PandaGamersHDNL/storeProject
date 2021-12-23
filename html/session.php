<?php
    class Session{
    static public function checkLogin()
    {
        if(isset($_SESSION["username"], $_SESSION["email"], $_SESSION["address"]))
            return true;
        return false;
        # code...
    }

    static public function setLogin(string $username, string $email, string $address)
    {
        //if session is started it will ignore this
        @session_start();
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        $_SESSION["address"] = $address;
    }

    static public function logout()
    {
        session_unset();
    }

    }
?>