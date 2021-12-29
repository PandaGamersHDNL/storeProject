<?php
    function printPage(int $currButton, string $category)
    {
        echo("<a href='". $_SERVER["PHP_SELF"] . "?". $category . "Prev'> <button>&lt;</button></a>");
        $start;
        if($currButton < 2)
        {
            $start = 1;
        } else{
            $start = $currButton - 2;
        }
        for($i = $start; $i < $start +5; $i++)
        {   
            if($currButton == $i)
                echo("<button><a class='selectedItem' href='". $_SERVER["PHP_SELF"]."?$category". "Page=$i'>$i</a></button>");
            else
                echo("<button><a href='". $_SERVER["PHP_SELF"]."?$category". "Page=$i'>$i</a></button>");
        }
        echo("<button href='". $_SERVER["PHP_SELF"]."'>&gt;</button>");
    }


include_once '/class/logger.php';

function handleErrors($errno, $errMsg, $errFile, $errLine) {
    (new Logger($errno, $errMsg, $errFile, $errLine))->error();

    exit();
}

function handleUncaughtException($e)
{
    (new Logger($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine()))->error();
    exit("An unexpected error occurred.");
}

set_exception_handler('handleUncaughtException');

set_error_handler('handleErrors');

?>

<nav>
    <ul>
        <li><h1><a href="/php-mysxl/storeProject/html/index.php">
            SOP 
        </a></h1>
        </li>
        <li id="user">
            <?php 
            include_once "classes/session.php";
            include_once "classes/db.php";

            $bLogin = Session::checkLogin();
            if($bLogin == true)
            {
                //make link to edit profile page
                echo('<a  href="/php-mysxl/storeProject/html/profile.php">'. $_SESSION["username"] .' </a>');
                $db = new Database();
                echo ("<ul id='DropDown'>");
                echo("<li><a href=\"/php-mysxl/storeProject/html/profile.php?logout=yes\"> logout</a></li>");
                if($db->checkAdmin($_SESSION["email"])){
                    echo('<li> <a href="/php-mysxl/storeProject/html/admin.php"> admin panel</a></li>');
                }
                echo("</ul>");
            } else{
                echo('<a href="/php-mysxl/storeProject/html/login.php">login/ signup</a>');
            }
        ?>
        </li>
        <li><a href="/php-mysxl/storeProject/html/cart.php" id="cart"> <?php 
            echo("cart");
        if($bLogin) {
            $amount = $db->getCartAmount($_SESSION["userID"]);
            if($amount > 0){
            echo(": $amount");
            }
        }
        
        ?></a></li>
    </ul>
</nav>
