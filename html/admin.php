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
        
        //product actions
            if(isset($_GET["Pid"], $_GET["Pname"], $_GET["Pdesc"], $_GET["Pcategory"], $_GET["Pprice"], $_GET["Pstock"],$_GET["Pimg"]))
            {
                $db = new Database();
                if($_GET["Pid"] == "unknown")
                {
                    $db->addProduct($_GET["Pname"], $_GET["Pdesc"], $_GET["Pcategory"], $_GET["Pprice"], $_GET["Pstock"],$_GET["Pimg"]);
                } else if ($_GET["Pid"] > 0){
                    $db->updateProduct($_GET["Pid"], $_GET["Pname"], $_GET["Pdesc"], $_GET["Pcategory"], $_GET["Pprice"], $_GET["Pstock"],$_GET["Pimg"]);
                }
            }
            if(isset($_GET["Pdel"]) && $_GET["Pdel"] > 0)
            {
                $db->delProduct($_GET["Pdel"]);
            }

//category actions
    if(isset($_GET["Cid"], $_GET["Cname"], $_GET["Cdesc"]))
    {
        $db = new Database();
        if($_GET["Cid"] == "unknown")
        {
            $db->addCategory($_GET["Cname"], $_GET["Cdesc"]);
        } else if ($_GET["Cid"] > 0){
            $db->updateCategory($_GET["Cid"], $_GET["Cname"], $_GET["Cdesc"]);
        }
    }
    if(isset($_GET["Cdel"]) && $_GET["Cdel"] > 0)
    {
        $db->delCategory($_GET["Cdel"]);
    }
?>

<div class="homeBox">
    <h2> users</h2>
    <?php 
   
            $db = new Database();
            include_once "user.php";
            $dbUsers = $db->getUsers($_SESSION[$products . "Page"]);
            User::printTable($dbUsers);
            //printPage($_SESSION[$users. "Page"], $users);
        ?>
    </div>
    <div class="homeBox">
        <h2> products</h2>
        <form><label for=""></label>  </from> <button> <a href='/php-mysxl/storeProject/html/editProduct.php?product=0'>add</a></button>
        <?php 
            include_once("products.php");
            $prods = $db->getProducts($_SESSION[$products . "Page"]);
            Products::printTable($prods);
            //add search by name
            //get users
            //print x amount of users
            //printPage($_SESSION[$products . "Page"], $products);
        ?>
    </div>
    <div class="homeBox">
        <h2> categories</h2>
        <form><label for=""></label>  </from> <button> <a href='/php-mysxl/storeProject/html/editCategory.php?category=0'>add</a></button>

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