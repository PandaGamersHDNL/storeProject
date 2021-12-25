<?php
    class Products {
        static public function printTable($products = null)
        {
            echo("<table class='users'>");
            echo("<tr><th>ID</th><th> admin? </th><th> username</th><th> email </th><th> address </th><th>edit</th><th>del</th></tr> ");
            while($product = mysqli_fetch_array($products)){
                echo("<tr><th>" . $product["productID"] . "</th><td>" 
                    . ($product["bAdmin"] ? "yes." : "no.") .  "</td><td>". $product["username"] ."</td><td>" . $product["email"] 
                    . "</td><td>". $product["address"] ."</td><td><a href='" . $_SERVER["PHP_SELF"] . "' >edit</a></td> 
                    <td><a href='" . $_SERVER["PHP_SELF"] . "' >del</a></td></tr> "
                ); 
            }
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
            while($product = mysqli_fetch_array($products)){
            echo("<div class='homeBox'>
            <h2>". $product["name"] ."</h2>
            <p><strong>description:</strong> " . $product["description"] ."</p>
            <p><strong>price:</strong> ". $product["price"]."</p>
            
            
            
            
            </div>");
            }
        }
    }

?>