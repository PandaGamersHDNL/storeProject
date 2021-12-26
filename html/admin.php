<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="../css/gen.css" />
    <title>admin SOP</title>
</head>

<body>
    <header>
        <?php include_once "nav.php"?>
    </header>
    <?php 
        $users = "users";
        $products = "products";
        if(Session::checkLogin() == true)
        {
            $db = new Database();
            if($db->checkAdmin($_SESSION["email"])  == false)
            {
                header("location: /php-mysxl/storeProject/html/index.php");
            }
            //check if set then add number if changed
            $_SESSION[$users. "Page"] = 1;
            $_SESSION[$products . "Page"] = 1;
        } else {
            header("location: /php-mysxl/storeProject/html/index.php");
        }

        
        ?>
        <?php
        //user actions
            if(isset($_GET["Uid"],$_GET["Uadmin"],$_GET["Uusername"],$_GET["Uemail"], $_GET["Uaddress"]))
            {
                $db = new Database();
                if($_GET["Uid"] > 0)
                {
                    $db->updateUser($_GET["Uid"], $_GET["Uemail"], $_GET["Uusername"], $_GET["Uaddress"], $_GET["Uadmin"]);
                }
            }
            if(isset($_GET["Udel"]) && $_GET["Udel"] > 0)
            {
                $db->delUser($_GET["Udel"]);
            }
        ?>

    <div class="homeBox">
        <h2> users</h2>
        <?php 
            $db = new Database();
            include_once "user.php";
            $dbUsers = $db->getUsers($_SESSION[$products . "Page"]);
            User::printTable($dbUsers);
            printPage($_SESSION[$users. "Page"], $users);
        ?>
    </div>
    <div class="homeBox">
        <h2> products</h2>
        <form><label for=""></label>  </from>
        <?php 
            include_once("products.php");
            $prods = $db->getProducts($_SESSION[$products . "Page"]);
            Products::printTable($prods);
            //add search by name
            //get users
            //print x amount of users
            printPage($_SESSION[$products . "Page"], $products);
        ?>
    </div>
    <div class="homeBox">
        <h2> categories</h2>
        <?php 
            include_once("products.php");
            $categories = $db->getCategories();
            if($categories != false)
                Products::categoryTable($categories);
            //printPage($_SESSION[$categories . "Page"], $products);
        ?>
    </div>
</body>

</html>