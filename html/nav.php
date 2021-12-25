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

?>

<nav>
    <ul>
        <li><h1><a href="/php-mysxl/storeProject/html/index.php">
            SOP 
        </a></h1>
        </li>
        <li>
            <div id="searchItems"> search:<input type="text" /> </div>
        </li>
        <li id="user">
            <?php 
            include "session.php";
            include "db.php";

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
            //load cart amount (only not payed ones)
        ?>
        </li>
        <li>cart</li>
    </ul>
</nav>
<!-- TODO make check box list from this (join query) + add price filter (seperate file?) -->
<nav>
    <ul>
        <li>category1</li>
        <li>category2</li>
        <li>category3</li>
        <li>category4</li>
        <li>category5</li>
</nav>