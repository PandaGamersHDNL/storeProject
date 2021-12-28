<?php
include_once("session.php");
include_once("db.php");
    if(Session::checkLogin() && isset($_POST["productID"], $_POST["amount"]))
    {
        $db = new Database();
        $db->addOrder($_SESSION["userID"], $_POST["productID"], $_POST["amount"]);
        echo("cart: " . $db->getCartAmount($_SESSION["userID"]));
        //get count of unpayed orders
    } else {
        echo("fail");
    }
?>