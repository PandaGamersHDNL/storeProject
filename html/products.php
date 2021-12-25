<?php
    class Products {
        static public function printTable($products = null)
        {
            while($product = mysqli_fetch_array($products)){
                echo("<tr><th>" . $product["productID"] . "</th><td>" 
                    . ($product["bAdmin"] ? "yes." : "no.") .  "</td><td>". $product["username"] ."</td><td>" . $product["email"] 
                    . "</td><td>". $product["address"] ."</td><td><a href='" . $_SERVER["PHP_SELF"] . "' >edit</a></td> 
                    <td><a href='" . $_SERVER["PHP_SELF"] . "' >del</a></td></tr> "
                ); 
            }
        }
    }

?>