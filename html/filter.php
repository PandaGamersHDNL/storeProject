<?php
    if(isset($_POST["min"], $_POST["max"]))
    {
        include_once("classes/db.php");
        include_once("classes/products.php");
        $db = new Database;
        $categories = array();
        $cats = $db->getCategories();
        while($c = mysqli_fetch_array($cats))
        {
            if(@$_POST["category" . $c["categoryID"]])
            {
                array_push($categories, $c["categoryID"]);
            }
        }
                                                                                                //page
        $prods = $db->filterProducts(((float)$_POST["min"]),((float) $_POST["max"]), $categories, 1);
        if($prods)
            Products::printDiv($prods);
        else
            echo("<div class='homeBox'><p>there are no products</p> </div>" );
        
    }
?>