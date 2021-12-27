<?php
    class Products {
        static public function printTable($products = null)
        {
            //TODO add stock + img
            echo("<table class='users'>");
            echo("<tr><th>ID</th><th> name </th><th> description</th><th> price </th><th> category </th><th>edit</th><th>del</th></tr> ");
            while($product = mysqli_fetch_array($products)){
                echo("<tr><th>" . $product["productID"] . "</th><td>" 
                    . ($product["name"]) .  "</td><td>". $product["description"] ."</td><td>" . $product["price"] 
                    . "</td><td>". Products::getCategoryName($product["categoryID"])["name"] ."</td><td><a href='/php-mysxl/storeProject/html/editProduct.php?product=" . $product["productID"] . "' >edit</a></td> 
                    <td><a href='" . $_SERVER["PHP_SELF"] . "?Pdel=" . $product["productID"] . "' >del</a></td></tr> "
                ); 
            }
            echo("</table>");
        }

        static public function categoryTable($categories)
        {
            //TODO add delete/edit/add
            echo("<table class='users'>");
            echo("<tr><th>ID</th><th> name </th><th> description</th></tr> ");
            while($category = mysqli_fetch_array($categories)){
                echo("<tr><th>" . $category["categoryID"] . "</th><td>" 
                    . ($category["name"] ) .  "</td><td>". $category["description"] . "</td></tr> "
                ); 
            } 
            echo("</table>");
        }

        static public function printDiv($products = null)
        {
            //TODO add image
            while($product = mysqli_fetch_array($products)){
            echo("<div class='homeBox'>
            <h2>". $product["name"] ."</h2>
            <p><strong>description:</strong> " . $product["description"] ."</p>
            <p><strong>category:</strong> " . Products::getCategoryName($product["categoryID"])["name"] ."</p>
            <p><strong>price:</strong> ". $product["price"]."</p>
            
            
            
            
            </div>");
            }
        }

        static function getCategoryName(int $categoryID = null)
        {
            include_once("db.php");
            $db = new Database();
            $categors = $db->getCategories();
            
            while($c = mysqli_fetch_array($categors))
            {
                if($c["categoryID"] == $categoryID)
                {
                    return $c;
                }
            }
            return false;
        }
    }

?>