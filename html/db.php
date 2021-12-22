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

        $query = "select email from users where email = '". $email . "';";
        $user = mysqli_query($this->link, $query) or die("add user failed");
        if ($user->num_rows == 0)
        {
            $password = password_hash($password, PASSWORD_DEFAULT, [PASSWORD_DEFAULT]);
            $query = "INSERT INTO users (username, email, password, address, bAdmin) 
                VALUE ('". $username . "', '". $email . "', '" . $password . "', '" . $address  . "', FALSE)";
            mysqli_query($this->link, $query) or die("add user failed");
            echo "<br/>sign up successfull";
        } else {
            echo "<br/>user already exists";
        }
        //mysqli_real_escape_string(link, string)
        //filter_var();
    }
}

?>