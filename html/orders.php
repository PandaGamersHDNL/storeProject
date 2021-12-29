<?php
    class Orders{
        static public function printTable($orders = null, bool $bPayDate)
        {
            //TODO make amount changable? update db then (make button next to amount for changing?)
            echo("<table><tr>");
            //TODO add stock?
            echo("<th>product name</th><th>product description</th><th>amount</th>");
            if($bPayDate)
                echo("<th>pay date</th>");
            if(!$bPayDate)
            echo("<th>delete</th></tr>");
            $db = new Database();
            while($order = mysqli_fetch_array($orders))
            {
            echo("<tr>");
            $product = $db->getProduct($order["productID"]);
            echo("<td>".$product["name"]."</td>");
            echo("<td>".$product["description"]."</td>");
            echo("<td>".$order["amount"]."</td>");
            if($bPayDate)
                echo("<td>" . (isset($order["payDate"]) == true ? $order["payDate"] : "not set")  ."</td>");
            if(!$bPayDate)
                echo("<td><a href='".$_SERVER["PHP_SELF"]. "'>delete</a></td>");
            echo("</tr>");
            }
            echo("</table>");
        }

    }
?>