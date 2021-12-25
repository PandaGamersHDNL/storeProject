<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="../css/gen.css" /> 
    <title>sop</title>
</head>
<body>
    <header>
        <?php include "nav.php"?>
        
    </header>
    <div class="container-fluid">
        <?php
        include "products.php";
        $db = new Database();
        $prod = $db->getProducts(1);
        if($prod != false){
            Products::printDiv($prod);
        }
        else{
            echo $prod;
        }
        ?>
        <!-- use this structure 
        rows
            column
                item(desc, name,etc)
        
        
        
        -->
    </div>
</body>
</html>