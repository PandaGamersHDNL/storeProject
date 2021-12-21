<?php
class Database{
    public $host = "localhost";
    public $user = "Webuser";
    //bad practice (this is for a project => no sensitive data) => env file
    public $password = "Lab2020";
    public $database = "storedb";
    public $host;

    function __construct()
    {
        connectDB();
    }

    public function connectDB(){
        $this->$host = mysqli_connect($this->$host, $this->$user, $this->$password) or die("error: no connection can be made to the host of the db");
        openDB();
    }
    
    public function openDB()
    {
        mysqli_select_db($this->$link, $this->$database) or die("couldn't open database");
    }
}

?>