<?php
class Database{
    public $host = "localhost";
    public $user = "Webuser";
    //bad practice (this is for a project => no sensitive data) => env file
    public $password = "Lab2020";
    public $database = "storedb";
    public mysqli $link;

    function __construct()
    {
        $this->connectDB();
    }

    public function connectDB(){
        $this->link = mysqli_connect($this->host, $this->user, $this->password) or die("error: no connection can be made to the host of the db");
        $this->openDB();
    }
    
    public function openDB()
    {
        mysqli_select_db($this->link, $this->database) or die("couldn't open database");
    }

    public function addUser(string $username, string $email, string $password, string $address )
    {
        $username = mysqli_real_escape_string($this->link, $username);
        $email = mysqli_real_escape_string($this->link, $email);
        $address = mysqli_real_escape_string($this->link, $address);

        $query = "SELECT email FROM users WHERE email = '". $email . "';";
        $user = mysqli_query($this->link, $query) or die("add user failed");
        if ($user->num_rows == 0)
        {
            $password = password_hash($password, PASSWORD_DEFAULT, [PASSWORD_DEFAULT]);
            $query = "INSERT INTO users (username, email, password, address, bAdmin) 
                VALUE ('". $username . "', '". $email . "', '" . $password . "', '" . $address  . "', FALSE)";
            mysqli_query($this->link, $query) or die("add user failed");
            echo "<br/>sign up successfull";
            Session::setLogin($username, $email, $address);
            header("location: /php-mysxl/storeProject/html/index.php");
        } else {
            echo "<br/>user already exists";
        }
        //mysqli_real_escape_string(link, string)
        //filter_var();
    }

    public function verifyUser(string $email, string $password)
    {
        $email = mysqli_real_escape_string($this->link, $email);
        $query = "select username, email, address, password from users where email = '$email'; ";
        $users = mysqli_query($this->link, $query) or die("get password failed");
        if($users->num_rows > 0){
            $user = mysqli_fetch_array($users);
            $hash = $user["password"];
            if(password_verify($password, $hash)){
                //include "session.php";
                echo("login successful");
                Session::setLogin($user["username"], $user["email"], $user["address"]);
                header("location: /php-mysxl/storeProject/html/index.php");
                return true;
            } 
        }
        echo("Password or username is incorrect");
        return false;
    }

    public function checkAdmin(string $email = null)
    {
        $email = mysqli_real_escape_string($this->link, $email);
        $query = "SELECT bAdmin FROM users WHERE email = '$email'; ";
        $users = mysqli_query($this->link, $query) or die("get password failed");
        if($users->num_rows > 0){
            $user = mysqli_fetch_array($users);
            return $user["bAdmin"] ? true : false;
        }
        //TODO error if you can't find user?
        return false;
    }

    public function getUsers(int $page, int $perPage = 10)
    {
        $page = filter_var($page, FILTER_VALIDATE_INT);
        $query = "SELECT * FROM ( SELECT (ROW_NUMBER() over ()) as row, users.* FROM users) as t WHERE row BETWEEN ". (($page -1) * $perPage) + 1 . " and ". $page * $perPage  .";";
        $users = mysqli_query($this->link, $query) or die("get users failed");
        if ($users->num_rows > 0) {
            return $users;
        }
        return false;
    }

    
}

?>