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
        <?php include "nav.php"?>
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
            $_SESSION[$users. "Page"] = 1;
            $_SESSION[$products . "Page"] = 1;
         } else {
            header("location: /php-mysxl/storeProject/html/index.php");
         }
    ?>
    <div class="homeBox">
        <h2> users</h2>
        <?php 
            $db = new Database();
            include "user.php";
            $dbUsers = $db->getUsers($_SESSION[$products . "Page"]);
            User::printTable($dbUsers);
            printPage($_SESSION[$users. "Page"], $users);
        ?>
    </div>
    <div class="homeBox">
        <h2> products</h2>
        <form><label for=""></label>  </from>
        <?php 
            
            //add search by name
            //get users
            //print x amount of users
            printPage($_SESSION[$products . "Page"], $products);
        ?>
    </div>
</body>

</html>