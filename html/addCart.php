<?php
include_once("classes/session.php");
include_once("classes/db.php");
include_once("classes/logger.php");
try{
    if(Session::checkLogin() && isset($_POST["productID"], $_POST["amount"]))
    {
        $db = new Database();
        $db->addOrder($_SESSION["userID"], $_POST["productID"], $_POST["amount"]);
        echo("cart: " . $db->getCartAmount($_SESSION["userID"]));
    } else {
        echo("<script>alert('you have to log in to add to cart')");
    }
} catch (Exception $e)
{
    (new Logger($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine()))->error();
    exit("An unexpected error occurred.");
}
?>