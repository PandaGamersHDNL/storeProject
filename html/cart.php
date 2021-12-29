<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="../css/gen.css" /> 
    <title>SOP</title>
</head>
<body>
    <header>
        <?php include_once "nav.php"?>
    </header>
    <div class="container-fluid">
    <?php
        if(!Session::checkLogin())
        {
            header("location: /php-mysxl/storeProject/html/login.php");
        }
        $db = new Database();
        include_once("classes/orders.php");  
        
        if(isset($_GET["Odel"]))
        {
            $db->delOrder($_GET["Odel"]);
        }
        
        ?>
        <div class="homeBox">
            <h2>cart</h2>
            <?php
                $orders = $db->getOrders($_SESSION["userID"], false);
                if($orders != false){
                    $price = Orders::printTable($orders, false);
                    echo("<p>$price</p>");
                }else
                    echo("no items in cart");
              ?>  
        </div>
        <div class="homeBox">
            <h2>bought previously</h2>
            <?php
                $orders = $db->getOrders($_SESSION["userID"], true);
                if($orders != false)
                    Orders::printTable($orders, true);
                else
                    echo("no items in have been ordered yet");
              ?>  
        </div>
        <div class="homeBox">
            
        </div>
    </div>
</body>
</html>