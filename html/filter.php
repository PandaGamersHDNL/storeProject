<?php
include_once("classes/logger.php")
try{
    if(isset($_POST["min"], $_POST["max"], $_POST["min"]))
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
        $prods = $db->filterProducts( $categories, 1,((float)$_POST["min"]),((float) $_POST["max"]), $_POST["searchItems"]);
        if($prods)
            Products::printDiv($prods);
        else
            echo("<div class='homeBox'><p>there are no products</p> </div>" );
        
    }
} catch (Exception $e)
{
    (new Logger($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine()))->error();
    exit("An unexpected error occurred.");
}
?>