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
    <script src="./cart.js" ></script>
</head>
<body>
    <header>
        <?php include_once "nav.php"?>
        
    </header>
    <div class="container-fluid">
        <div class="homeBox">
            <h2> filter</h2>
                <?php
                    $db = new Database();
                    $cats = $db->getCategories();
                    $boxes = "";
                    while($c = mysqli_fetch_array($cats)){
                    $boxes = $boxes . '<input type="checkbox" id="category'.$c["categoryID"].'" name="category'.$c["categoryID"].'" value="category'.$c["categoryID"].'" />
                    <label for="category'.$c["categoryID"].'"> '.$c["name"].'</label><br>';
                    }
                    
                    echo("<form id='filter'><div><label for='searchItems'> search:</label><input type='text' id='searchItems' name='searchItems' /><br/>
                    <label for='min'>min: </label><input type='number' step='0.01' value='0' id='min' name='min' /><br/>
                    <label for='max'>max: </label><input type='number' step='0.01' value='0' id='max' name='max' /></div><br/><div><h3>Categories</h3>$boxes</div>
                    <button onclick='filterItems()'>submit</button></form>");
                ?>
        </div>
        <div id="products">
        <?php
        include_once "classes/products.php";
        $db = new Database();
        $prod = $db->getProducts(1);
        if($prod != false){
            Products::printDiv($prod);
        }
        ?>
        </div>

    </div>
</body>
</html>