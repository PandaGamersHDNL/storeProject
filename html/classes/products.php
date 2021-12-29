<?php
    class Products {
        static public function printTable($products = null)
        {
            //TODO add stock + img
            echo("<table class='users'>");
            echo("<tr><th>ID</th><th> name </th><th> description</th><th> price </th><th> category </th><th>edit</th><th>del</th></tr> ");
            while($product = mysqli_fetch_array($products)){
                echo("<tr><th>" . htmlspecialchars($product["productID"]) . "</th><td>" 
                    . (htmlspecialchars($product["name"])) .  "</td><td>". htmlspecialchars($product["description"]) ."</td><td>" . htmlspecialchars($product["price"]) 
                    . "</td><td>". Products::getCategory($product["categoryID"])["name"] ."</td><td><a href='/php-mysxl/storeProject/html/editProduct.php?product=" . htmlspecialchars($product["productID"]) . "' >edit</a></td> 
                    <td><a href='" . $_SERVER["PHP_SELF"] . "?Pdel=" . htmlspecialchars($product["productID"]) . "' >del</a></td></tr> "
                    
                ); 
            }
            echo("</table>");
        }

        static public function categoryTable($categories)
        {
            echo("<table class='users'>");
            echo("<tr><th>ID</th><th> name </th><th> description</th><th>edit</th><th>del</th></tr> ");
            while($category = mysqli_fetch_array($categories)){
                echo("<tr><th>" . htmlspecialchars($category["categoryID"]) . "</th><td>" 
                    . (htmlspecialchars($category["name"] )) .  "</td><td>". htmlspecialchars($category["description"]) . "</td><td><a href='/php-mysxl/storeProject/html/editCategory.php?category=" . htmlspecialchars($category["categoryID"]) . "' >edit</a></td> 
                    <td><a href='" . $_SERVER["PHP_SELF"] . "?Cdel=" . $category["categoryID"] . "' >del</a></td></tr> "
                ); 
            } 
            echo("</table>");
        }

        static public function printDiv($products = null)
        {
            //TODO add image
            //TODO add order button + amount
            while($product = mysqli_fetch_array($products)){
            echo("<div class='homeBox'>
            <h2>". htmlspecialchars($product["name"]) ."</h2>
            <p><strong>description:</strong> " . $product["description"] ."</p>
            <p><strong>category:</strong> " . htmlspecialchars(Products::getCategory($product["categoryID"])["name"]) ."</p>
            <p><strong>price:</strong> ". htmlspecialchars($product["price"])."</p>
            <label for='amount".htmlspecialchars($product["productID"])."'>amount: </label><input type='number' id='amount".htmlspecialchars($product["productID"])."' name='amount".htmlspecialchars($product["productID"])."' value='1' />
            <button onclick='addToCart(".htmlspecialchars($product["productID"]).")'> add to cart </button>
            </div>");
            }
        }

        static function getCategory(int $categoryID = null)
        {
            include_once("classes/db.php");
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